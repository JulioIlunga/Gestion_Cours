<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241018133845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responses ADD type_response_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F94B0EAFFD1 FOREIGN KEY (type_response_id) REFERENCES type_responses (id)');
        $this->addSql('CREATE INDEX IDX_315F9F94B0EAFFD1 ON responses (type_response_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F94B0EAFFD1');
        $this->addSql('DROP INDEX IDX_315F9F94B0EAFFD1 ON responses');
        $this->addSql('ALTER TABLE responses DROP type_response_id');
    }
}
