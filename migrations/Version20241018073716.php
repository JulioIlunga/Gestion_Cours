<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241018073716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluations_classes DROP FOREIGN KEY FK_1F2E97299E225B24');
        $this->addSql('ALTER TABLE evaluations_classes DROP FOREIGN KEY FK_1F2E9729788B35D6');
        $this->addSql('DROP TABLE evaluations_classes');
        $this->addSql('ALTER TABLE cours CHANGE teacher teacher VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE evaluations ADD classe_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691D3633CA6F FOREIGN KEY (classe_id_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_3B72691D3633CA6F ON evaluations (classe_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evaluations_classes (evaluations_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_1F2E9729788B35D6 (evaluations_id), INDEX IDX_1F2E97299E225B24 (classes_id), PRIMARY KEY(evaluations_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evaluations_classes ADD CONSTRAINT FK_1F2E97299E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluations_classes ADD CONSTRAINT FK_1F2E9729788B35D6 FOREIGN KEY (evaluations_id) REFERENCES evaluations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours CHANGE teacher teacher VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691D3633CA6F');
        $this->addSql('DROP INDEX IDX_3B72691D3633CA6F ON evaluations');
        $this->addSql('ALTER TABLE evaluations DROP classe_id_id');
    }
}
