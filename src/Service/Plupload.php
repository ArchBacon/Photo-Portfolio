<?php

declare(strict_types=1);

namespace App\Service;

use JetBrains\PhpStorm\Pure;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Ramsey\Uuid\Uuid;
use RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class Plupload
{
    private array $files;
    private ?string $uniqueFileName;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __construct(private ContainerBagInterface $container)
    {
        $this->files = $_FILES;
        $this->uniqueFileName = null;

        $uploadsDir = $this->container->get('tmp') . 'uploads\\';
        if (!file_exists($uploadsDir) && !mkdir($uploadsDir, 0777, true) && !is_dir($uploadsDir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $uploadsDir));
        }

        $galleryDir = $this->container->get('uploads');
        if (!file_exists($uploadsDir) && !mkdir($galleryDir, 0777, true) && !is_dir($galleryDir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $galleryDir));
        }
    }

    public function isValid(): bool
    {
        return !empty($this->files) && !$this->files['file']['error'];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function tryAppendChunk(): void
    {
        $file = fopen($this->container->get('tmp') . 'uploads\\' . $this->fileName() . '.part', $this->chunkNumber() === 1 ? 'wb' : 'ab');
        $chunk = fopen($_FILES['file']['tmp_name'], 'rb');
        if ($chunk === false) {
            throw new UploadException('Failed to open input stream.');
        }

        /** @noinspection PhpAssignmentInConditionInspection */
        while ($buffer = fread($chunk, 4096)) {
            fwrite($file, $buffer);
        }

        fclose($chunk);
        fclose($file);
        unlink($_FILES['file']['tmp_name']);
    }

    public function chunkNumber(): int
    {
        if (!isset($_REQUEST['chunk'])) {
            return 0;
        }

        return (int)$_REQUEST['chunk'] + 1;
    }

    #[Pure]
    public function isComplete(): bool
    {
        return $this->totalChunks() === 0 || $this->chunkNumber() === $this->totalChunks();
    }

    public function totalChunks(): int
    {
        return isset($_REQUEST['chunks']) ? (int)$_REQUEST['chunks'] : 0;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function save(): bool
    {
        $this->uniqueFileName = Uuid::uuid4()->toString() . '.' . $this->fileExtension();

        return rename(
            "{$this->container->get('tmp')}uploads\\{$this->fileName()}.part",
            $this->container->get('uploads') . $this->uniqueFileName()
        );
    }

    public function fileExtension(): string
    {
        return pathinfo($this->fileName(), PATHINFO_EXTENSION);
    }

    public function uniqueFileName(): ?string
    {
        return $this->uniqueFileName;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function lastSavedFile(): string
    {
        return $this->container->get('uploads') . $this->uniqueFileName();
    }

    #[Pure]
    public function lastSavedFilename(): string
    {
        return $this->uniqueFileName();
    }

    private function fileName(): string
    {
        return $_REQUEST['name'] ?? $_FILES['file']['name'];
    }
}