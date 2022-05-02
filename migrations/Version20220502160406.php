<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502160406 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE social ADD settings_id INT NOT NULL');
        $this->addSql('ALTER TABLE social ADD CONSTRAINT FK_7161E18759949888 FOREIGN KEY (settings_id) REFERENCES settings (id)');
        $this->addSql('CREATE INDEX IDX_7161E18759949888 ON social (settings_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social DROP FOREIGN KEY FK_7161E18759949888');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP INDEX IDX_7161E18759949888 ON social');
        $this->addSql('ALTER TABLE social DROP settings_id');
    }
}
