<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017184647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5456C5646');
        $this->addSql('DROP INDEX IDX_8ADC54D5456C5646 ON questions');
        $this->addSql('ALTER TABLE questions ADD evaluations_id INT DEFAULT NULL, CHANGE evaluation_id evaluation_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5BAB3E3A6 FOREIGN KEY (evaluation_id_id) REFERENCES evaluations (id)');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5788B35D6 FOREIGN KEY (evaluations_id) REFERENCES evaluations (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5BAB3E3A6 ON questions (evaluation_id_id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5788B35D6 ON questions (evaluations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5BAB3E3A6');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5788B35D6');
        $this->addSql('DROP INDEX IDX_8ADC54D5BAB3E3A6 ON questions');
        $this->addSql('DROP INDEX IDX_8ADC54D5788B35D6 ON questions');
        $this->addSql('ALTER TABLE questions ADD evaluation_id INT DEFAULT NULL, DROP evaluation_id_id, DROP evaluations_id');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluations (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5456C5646 ON questions (evaluation_id)');
    }
}
