<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017200136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evaluation_types');
        $this->addSql('ALTER TABLE evaluations ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691D7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_3B72691D7ECF78B0 ON evaluations (cours_id)');
        $this->addSql('ALTER TABLE students CHANGE class_id_id class_id_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evaluation_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691D7ECF78B0');
        $this->addSql('DROP INDEX IDX_3B72691D7ECF78B0 ON evaluations');
        $this->addSql('ALTER TABLE evaluations DROP cours_id');
        $this->addSql('ALTER TABLE students CHANGE class_id_id class_id_id INT DEFAULT NULL');
    }
}
