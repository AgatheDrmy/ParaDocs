<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250421193339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE chapitre (id INT AUTO_INCREMENT NOT NULL, theme_id INT NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_8C62B02559027487 (theme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE difficulte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, theme_eval_id INT NOT NULL, difficulte_eval_id INT NOT NULL, evaluation_utilisateur_id INT NOT NULL, titre VARCHAR(64) NOT NULL, is_calculatrice TINYINT(1) NOT NULL, is_ordinateur TINYINT(1) NOT NULL, is_document TINYINT(1) NOT NULL, autre_modalite VARCHAR(255) NOT NULL, introduction LONGTEXT NOT NULL, date_heure DATETIME NOT NULL, date_creation DATE NOT NULL, duree TIME NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_1323A5758C585DA7 (theme_eval_id), INDEX IDX_1323A575C9ADC5C1 (difficulte_eval_id), INDEX IDX_1323A575ADAC3987 (evaluation_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE evaluation_question (evaluation_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_BBB93068456C5646 (evaluation_id), INDEX IDX_BBB930681E27F6BF (question_id), PRIMARY KEY(evaluation_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE proposition (id INT AUTO_INCREMENT NOT NULL, id_question_id INT NOT NULL, contenu LONGTEXT NOT NULL, is_correcte TINYINT(1) NOT NULL, INDEX IDX_C7CDC3536353B48 (id_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, type_question_id INT NOT NULL, difficulte_id INT NOT NULL, question_utilisateur_id INT NOT NULL, chapitre_id INT NOT NULL, enonce VARCHAR(512) NOT NULL, image VARCHAR(512) DEFAULT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_B6F7494E553E212E (type_question_id), INDEX IDX_B6F7494EE6357589 (difficulte_id), INDEX IDX_B6F7494E13A874B6 (question_utilisateur_id), INDEX IDX_B6F7494E1FBEEF7B (chapitre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, photo VARCHAR(512) DEFAULT NULL, token VARCHAR(50) NOT NULL, nb_questions INT NOT NULL, nb_eval INT NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B02559027487 FOREIGN KEY (theme_id) REFERENCES theme (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5758C585DA7 FOREIGN KEY (theme_eval_id) REFERENCES theme (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575C9ADC5C1 FOREIGN KEY (difficulte_eval_id) REFERENCES difficulte (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575ADAC3987 FOREIGN KEY (evaluation_utilisateur_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation_question ADD CONSTRAINT FK_BBB93068456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation_question ADD CONSTRAINT FK_BBB930681E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC3536353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT FK_B6F7494E553E212E FOREIGN KEY (type_question_id) REFERENCES type (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT FK_B6F7494EE6357589 FOREIGN KEY (difficulte_id) REFERENCES difficulte (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT FK_B6F7494E13A874B6 FOREIGN KEY (question_utilisateur_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT FK_B6F7494E1FBEEF7B FOREIGN KEY (chapitre_id) REFERENCES chapitre (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B02559027487
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5758C585DA7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575C9ADC5C1
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575ADAC3987
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation_question DROP FOREIGN KEY FK_BBB93068456C5646
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation_question DROP FOREIGN KEY FK_BBB930681E27F6BF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC3536353B48
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E553E212E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EE6357589
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E13A874B6
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E1FBEEF7B
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE chapitre
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE difficulte
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE evaluation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE evaluation_question
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE proposition
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE question
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE theme
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE type
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
