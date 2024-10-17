<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017152930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CEA000B10 FOREIGN KEY (class_id) REFERENCES classes (id)');
        $this->addSql('DROP INDEX cours_id ON cours_classes');
        $this->addSql('ALTER TABLE cours_classes DROP FOREIGN KEY cours_classes_ibfk_2');
        $this->addSql('ALTER TABLE cours_classes CHANGE cours_id cours_id INT NOT NULL, CHANGE classe_id classe_id INT NOT NULL, ADD PRIMARY KEY (cours_id, classe_id)');
        $this->addSql('DROP INDEX classe_id ON cours_classes');
        $this->addSql('CREATE INDEX IDX_41EB17BE8F5EA509 ON cours_classes (classe_id)');
        $this->addSql('ALTER TABLE cours_classes ADD CONSTRAINT cours_classes_ibfk_2 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY evaluations_ibfk_1');
        $this->addSql('ALTER TABLE evaluations CHANGE evaluation_type evaluation_type VARCHAR(255) NOT NULL, CHANGE nom_evaluation nom_evaluation VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX cours_id_id ON evaluations');
        $this->addSql('CREATE INDEX IDX_3B72691D4F221781 ON evaluations (cours_id_id)');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT evaluations_ibfk_1 FOREIGN KEY (cours_id_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_questions_evaluations');
        $this->addSql('DROP INDEX FK_questions_evaluations ON questions');
        $this->addSql('ALTER TABLE questions DROP evaluation_id');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_TEACHER_ID');
        $this->addSql('DROP INDEX FK_TEACHER_ID ON students');
        $this->addSql('ALTER TABLE students DROP teacher_id, CHANGE class_id_id class_id_id INT NOT NULL, CHANGE gender gender VARCHAR(30) NOT NULL, CHANGE generale_average generale_average DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE type_responses CHANGE response_format type VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CEA000B10');
        $this->addSql('ALTER TABLE cours_classes DROP INDEX primary, ADD UNIQUE INDEX cours_id (cours_id, classe_id)');
        $this->addSql('ALTER TABLE cours_classes DROP FOREIGN KEY FK_41EB17BE8F5EA509');
        $this->addSql('ALTER TABLE cours_classes CHANGE cours_id cours_id INT DEFAULT NULL, CHANGE classe_id classe_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX idx_41eb17be8f5ea509 ON cours_classes');
        $this->addSql('CREATE INDEX classe_id ON cours_classes (classe_id)');
        $this->addSql('ALTER TABLE cours_classes ADD CONSTRAINT FK_41EB17BE8F5EA509 FOREIGN KEY (classe_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691D4F221781');
        $this->addSql('ALTER TABLE evaluations CHANGE evaluation_type evaluation_type VARCHAR(50) DEFAULT \'\' NOT NULL, CHANGE nom_evaluation nom_evaluation VARCHAR(50) DEFAULT \'\'');
        $this->addSql('DROP INDEX idx_3b72691d4f221781 ON evaluations');
        $this->addSql('CREATE INDEX cours_id_id ON evaluations (cours_id_id)');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691D4F221781 FOREIGN KEY (cours_id_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE questions ADD evaluation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_questions_evaluations FOREIGN KEY (evaluation_id) REFERENCES evaluations (id)');
        $this->addSql('CREATE INDEX FK_questions_evaluations ON questions (evaluation_id)');
        $this->addSql('ALTER TABLE students ADD teacher_id INT DEFAULT NULL, CHANGE class_id_id class_id_id INT DEFAULT NULL, CHANGE gender gender VARCHAR(30) DEFAULT NULL, CHANGE generale_average generale_average DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_TEACHER_ID FOREIGN KEY (teacher_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX FK_TEACHER_ID ON students (teacher_id)');
        $this->addSql('ALTER TABLE type_responses CHANGE type response_format VARCHAR(50) NOT NULL');
    }
}
