<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241018074020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691D3633CA6F');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691D8F5EA509');
        $this->addSql('DROP INDEX IDX_3B72691D8F5EA509 ON evaluations');
        $this->addSql('DROP INDEX IDX_3B72691D3633CA6F ON evaluations');
        $this->addSql('ALTER TABLE evaluations DROP classe_id, DROP classe_id_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluations ADD classe_id INT NOT NULL, ADD classe_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691D3633CA6F FOREIGN KEY (classe_id_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_3B72691D8F5EA509 ON evaluations (classe_id)');
        $this->addSql('CREATE INDEX IDX_3B72691D3633CA6F ON evaluations (classe_id_id)');
    }
}
