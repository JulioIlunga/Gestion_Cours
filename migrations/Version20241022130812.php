<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241022130812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluations CHANGE evaluation_type evaluation_type VARCHAR(255) NOT NULL, CHANGE nom_evaluation nom_evaluation VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691D7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_3B72691D7ECF78B0 ON evaluations (cours_id)');
        $this->addSql('CREATE INDEX IDX_3B72691D8F5EA509 ON evaluations (classe_id)');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluations MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691D7ECF78B0');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691D8F5EA509');
        $this->addSql('DROP INDEX IDX_3B72691D7ECF78B0 ON evaluations');
        $this->addSql('DROP INDEX IDX_3B72691D8F5EA509 ON evaluations');
        $this->addSql('DROP INDEX `primary` ON evaluations');
        $this->addSql('ALTER TABLE evaluations CHANGE evaluation_type evaluation_type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom_evaluation nom_evaluation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) DEFAULT NULL');
    }
}
