<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241013031308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, students_nbr INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_classes (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_classes_cours (cours_classes_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_F5D478599BDAA90D (cours_classes_id), INDEX IDX_F5D478597ECF78B0 (cours_id), PRIMARY KEY(cours_classes_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_classes_classes (cours_classes_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_EB063D59BDAA90D (cours_classes_id), INDEX IDX_EB063D59E225B24 (classes_id), PRIMARY KEY(cours_classes_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluations (id INT AUTO_INCREMENT NOT NULL, cours_id INT NOT NULL, evaluation_type_id INT NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, max_points INT NOT NULL, INDEX IDX_3B72691D4F221781 (cours_id), INDEX IDX_3B72691DE65F9419 (evaluation_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluations_classes (evaluations_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_1F2E9729788B35D6 (evaluations_id), INDEX IDX_1F2E97299E225B24 (classes_id), PRIMARY KEY(evaluations_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluations_questions (evaluations_id INT NOT NULL, questions_id INT NOT NULL, INDEX IDX_A1C1AF2A788B35D6 (evaluations_id), INDEX IDX_A1C1AF2ABCB134CE (questions_id), PRIMARY KEY(evaluations_id, questions_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluations_students_results (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, INDEX IDX_3E85E0A3F773E7CA (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluations_students_results_evaluations (evaluations_students_results_id INT NOT NULL, evaluations_id INT NOT NULL, INDEX IDX_AB4DC7A97ED3A274 (evaluations_students_results_id), INDEX IDX_AB4DC7A9788B35D6 (evaluations_id), PRIMARY KEY(evaluations_students_results_id, evaluations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, enonce_question VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responses (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, type_response_id INT NOT NULL, INDEX IDX_315F9F944FAF8F53 (question_id), INDEX IDX_315F9F9439F16C93 (type_response_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, class_id INT NOT NULL, firstname VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, gender VARCHAR(30) NOT NULL, birth_date DATETIME NOT NULL, place_of_birth VARCHAR(255) NOT NULL, parent_phone VARCHAR(20) NOT NULL, adress VARCHAR(255) NOT NULL, generale_average DOUBLE PRECISION NOT NULL, INDEX IDX_A4698DB29993BF61 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_responses (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours_classes_cours ADD CONSTRAINT FK_F5D478599BDAA90D FOREIGN KEY (cours_classes_id) REFERENCES cours_classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_classes_cours ADD CONSTRAINT FK_F5D478597ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_classes_classes ADD CONSTRAINT FK_EB063D59BDAA90D FOREIGN KEY (cours_classes_id) REFERENCES cours_classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_classes_classes ADD CONSTRAINT FK_EB063D59E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691D4F221781 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE evaluations ADD CONSTRAINT FK_3B72691DE65F9419 FOREIGN KEY (evaluation_type_id) REFERENCES evaluation_types (id)');
        $this->addSql('ALTER TABLE evaluations_classes ADD CONSTRAINT FK_1F2E9729788B35D6 FOREIGN KEY (evaluations_id) REFERENCES evaluations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluations_classes ADD CONSTRAINT FK_1F2E97299E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluations_questions ADD CONSTRAINT FK_A1C1AF2A788B35D6 FOREIGN KEY (evaluations_id) REFERENCES evaluations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluations_questions ADD CONSTRAINT FK_A1C1AF2ABCB134CE FOREIGN KEY (questions_id) REFERENCES questions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluations_students_results ADD CONSTRAINT FK_3E85E0A3F773E7CA FOREIGN KEY (student_id) REFERENCES students (id)');
        $this->addSql('ALTER TABLE evaluations_students_results_evaluations ADD CONSTRAINT FK_AB4DC7A97ED3A274 FOREIGN KEY (evaluations_students_results_id) REFERENCES evaluations_students_results (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluations_students_results_evaluations ADD CONSTRAINT FK_AB4DC7A9788B35D6 FOREIGN KEY (evaluations_id) REFERENCES evaluations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F944FAF8F53 FOREIGN KEY (question_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE responses ADD CONSTRAINT FK_315F9F9439F16C93 FOREIGN KEY (type_response_id) REFERENCES type_responses (id)');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB29993BF61 FOREIGN KEY (class_id) REFERENCES classes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_classes_cours DROP FOREIGN KEY FK_F5D478599BDAA90D');
        $this->addSql('ALTER TABLE cours_classes_cours DROP FOREIGN KEY FK_F5D478597ECF78B0');
        $this->addSql('ALTER TABLE cours_classes DROP FOREIGN KEY FK_EB063D59BDAA90D');
        $this->addSql('ALTER TABLE cours_classes DROP FOREIGN KEY FK_EB063D59E225B24');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691D4F221781');
        $this->addSql('ALTER TABLE evaluations DROP FOREIGN KEY FK_3B72691DE65F9419');
        $this->addSql('ALTER TABLE evaluations_classes DROP FOREIGN KEY FK_1F2E9729788B35D6');
        $this->addSql('ALTER TABLE evaluations_classes DROP FOREIGN KEY FK_1F2E97299E225B24');
        $this->addSql('ALTER TABLE evaluations_questions DROP FOREIGN KEY FK_A1C1AF2A788B35D6');
        $this->addSql('ALTER TABLE evaluations_questions DROP FOREIGN KEY FK_A1C1AF2ABCB134CE');
        $this->addSql('ALTER TABLE evaluations_students_results DROP FOREIGN KEY FK_3E85E0A3F773E7CA');
        $this->addSql('ALTER TABLE evaluations_students_results_evaluations DROP FOREIGN KEY FK_AB4DC7A97ED3A274');
        $this->addSql('ALTER TABLE evaluations_students_results_evaluations DROP FOREIGN KEY FK_AB4DC7A9788B35D6');
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F944FAF8F53');
        $this->addSql('ALTER TABLE responses DROP FOREIGN KEY FK_315F9F9439F16C93');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB29993BF61');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cours_classes');
        $this->addSql('DROP TABLE cours_classes_cours');
        $this->addSql('DROP TABLE cours_classes_classes');
        $this->addSql('DROP TABLE evaluation_types');
        $this->addSql('DROP TABLE evaluations');
        $this->addSql('DROP TABLE evaluations_classes');
        $this->addSql('DROP TABLE evaluations_questions');
        $this->addSql('DROP TABLE evaluations_students_results');
        $this->addSql('DROP TABLE evaluations_students_results_evaluations');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE responses');
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE type_responses');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
