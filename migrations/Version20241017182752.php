<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017182752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE evaluation_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evaluations_students_results DROP FOREIGN KEY FK_3E85E0A3F773E7CA');
        $this->addSql('DROP INDEX IDX_3E85E0A3F773E7CA ON evaluations_students_results');
        $this->addSql('ALTER TABLE evaluations_students_results CHANGE student_id student_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE evaluations_students_results ADD CONSTRAINT FK_3E85E0A3F773E7CA FOREIGN KEY (student_id_id) REFERENCES students (id)');
        $this->addSql('CREATE INDEX IDX_3E85E0A3F773E7CA ON evaluations_students_results (student_id_id)');
        $this->addSql('ALTER TABLE questions ADD evaluation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D5456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluations (id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D5456C5646 ON questions (evaluation_id)');
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F9439F16C93');
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F944FAF8F53');
        $this->addSql('DROP INDEX IDX_315F9F944FAF8F53 ON responses');
        $this->addSql('DROP INDEX IDX_315F9F9439F16C93 ON responses');
        $this->addSql('ALTER TABLE responses CHANGE question_id question_id_id INT DEFAULT NULL, CHANGE type_response_id type_response_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F9439F16C93 FOREIGN KEY (type_response_id_id) REFERENCES type_responses (id)');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F944FAF8F53 FOREIGN KEY (question_id_id) REFERENCES questions (id)');
        $this->addSql('CREATE INDEX IDX_315F9F944FAF8F53 ON responses (question_id_id)');
        $this->addSql('CREATE INDEX IDX_315F9F9439F16C93 ON responses (type_response_id_id)');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB29993BF61');
        $this->addSql('DROP INDEX IDX_A4698DB29993BF61 ON students');
        $this->addSql('ALTER TABLE students CHANGE class_id class_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB29993BF61 FOREIGN KEY (class_id_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_A4698DB29993BF61 ON students (class_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE evaluation_types');
        $this->addSql('ALTER TABLE evaluations_students_results DROP FOREIGN KEY FK_3E85E0A3F773E7CA');
        $this->addSql('DROP INDEX IDX_3E85E0A3F773E7CA ON evaluations_students_results');
        $this->addSql('ALTER TABLE evaluations_students_results CHANGE student_id_id student_id INT NOT NULL');
        $this->addSql('ALTER TABLE evaluations_students_results ADD CONSTRAINT FK_3E85E0A3F773E7CA FOREIGN KEY (student_id) REFERENCES students (id)');
        $this->addSql('CREATE INDEX IDX_3E85E0A3F773E7CA ON evaluations_students_results (student_id)');
        $this->addSql('ALTER TABLE questions DROP FOREIGN KEY FK_8ADC54D5456C5646');
        $this->addSql('DROP INDEX IDX_8ADC54D5456C5646 ON questions');
        $this->addSql('ALTER TABLE questions DROP evaluation_id');
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F944FAF8F53');
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F9439F16C93');
        $this->addSql('DROP INDEX IDX_315F9F944FAF8F53 ON responses');
        $this->addSql('DROP INDEX IDX_315F9F9439F16C93 ON responses');
        $this->addSql('ALTER TABLE responses CHANGE question_id_id question_id INT DEFAULT NULL, CHANGE type_response_id_id type_response_id INT NOT NULL');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F944FAF8F53 FOREIGN KEY (question_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F9439F16C93 FOREIGN KEY (type_response_id) REFERENCES type_responses (id)');
        $this->addSql('CREATE INDEX IDX_315F9F944FAF8F53 ON responses (question_id)');
        $this->addSql('CREATE INDEX IDX_315F9F9439F16C93 ON responses (type_response_id)');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB29993BF61');
        $this->addSql('DROP INDEX IDX_A4698DB29993BF61 ON students');
        $this->addSql('ALTER TABLE students CHANGE class_id_id class_id INT NOT NULL');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB29993BF61 FOREIGN KEY (class_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_A4698DB29993BF61 ON students (class_id)');
    }
}
