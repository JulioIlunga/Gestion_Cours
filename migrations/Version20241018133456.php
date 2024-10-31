<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241018133456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F9439F16C93');
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F944FAF8F53');
        $this->addSql('DROP INDEX IDX_315F9F944FAF8F53 ON responses');
        $this->addSql('DROP INDEX IDX_315F9F9439F16C93 ON responses');
        $this->addSql('ALTER TABLE responses DROP type_response_id_id, CHANGE question_id_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F941E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_315F9F941E27F6BF ON responses (question_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F941E27F6BF');
        $this->addSql('DROP INDEX UNIQ_315F9F941E27F6BF ON responses');
        $this->addSql('ALTER TABLE responses ADD type_response_id_id INT NOT NULL, CHANGE question_id question_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F9439F16C93 FOREIGN KEY (type_response_id_id) REFERENCES type_responses (id)');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F944FAF8F53 FOREIGN KEY (question_id_id) REFERENCES questions (id)');
        $this->addSql('CREATE INDEX IDX_315F9F944FAF8F53 ON responses (question_id_id)');
        $this->addSql('CREATE INDEX IDX_315F9F9439F16C93 ON responses (type_response_id_id)');
    }
}
