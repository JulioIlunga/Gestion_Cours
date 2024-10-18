<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017205027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes CHANGE section section VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cours ADD class_id INT DEFAULT NULL, CHANGE teacher teacher VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CEA000B10 FOREIGN KEY (class_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CEA000B10 ON cours (class_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes CHANGE section section VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CEA000B10');
        $this->addSql('DROP INDEX IDX_FDCA8C9CEA000B10 ON cours');
        $this->addSql('ALTER TABLE cours DROP class_id, CHANGE teacher teacher VARCHAR(255) DEFAULT NULL');
    }
}