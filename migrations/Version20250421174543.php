<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250421174543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE evaluation_question (evaluation_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_BBB93068456C5646 (evaluation_id), INDEX IDX_BBB930681E27F6BF (question_id), PRIMARY KEY(evaluation_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation_question ADD CONSTRAINT FK_BBB93068456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation_question ADD CONSTRAINT FK_BBB930681E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contient DROP FOREIGN KEY contient_evaluation0_FK
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contient DROP FOREIGN KEY contient_question_FK
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme_chapitre DROP FOREIGN KEY theme_chapitre_chapitre_FK
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme_chapitre DROP FOREIGN KEY theme_chapitre_theme0_FK
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contient
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE theme_chapitre
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre MODIFY id_chapitre INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON chapitre
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre ADD theme_id INT NOT NULL, CHANGE contenu contenu VARCHAR(255) NOT NULL, CHANGE id_chapitre id INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre ADD CONSTRAINT FK_8C62B02559027487 FOREIGN KEY (theme_id) REFERENCES theme (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8C62B02559027487 ON chapitre (theme_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE difficulte MODIFY id_difficulte INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON difficulte
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE difficulte CHANGE id_difficulte id INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE difficulte ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation MODIFY id_evaluation INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation DROP FOREIGN KEY evaluation_difficulte1_FK
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation DROP FOREIGN KEY evaluation_theme0_FK
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation DROP FOREIGN KEY evaluation_utilisateur_FK
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX evaluation_utilisateur_FK ON evaluation
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX evaluation_theme0_FK ON evaluation
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX evaluation_difficulte1_FK ON evaluation
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON evaluation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD theme_eval_id INT NOT NULL, ADD difficulte_eval_id INT NOT NULL, ADD evaluation_utilisateur_id INT NOT NULL, ADD is_calculatrice TINYINT(1) NOT NULL, ADD is_ordinateur TINYINT(1) NOT NULL, ADD is_document TINYINT(1) NOT NULL, ADD is_active TINYINT(1) NOT NULL, DROP mail, DROP id_theme, DROP id_difficulte, DROP calculatrice, DROP ordinateur, DROP documents, DROP active, CHANGE autre_modalite autre_modalite VARCHAR(255) NOT NULL, CHANGE introduction introduction LONGTEXT NOT NULL, CHANGE id_evaluation id INT AUTO_INCREMENT NOT NULL
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
            CREATE INDEX IDX_1323A5758C585DA7 ON evaluation (theme_eval_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1323A575C9ADC5C1 ON evaluation (difficulte_eval_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1323A575ADAC3987 ON evaluation (evaluation_utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition MODIFY id_reponse INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition DROP FOREIGN KEY proposition_question_FK
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX proposition_question_FK ON proposition
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON proposition
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition CHANGE contenu contenu LONGTEXT NOT NULL, CHANGE id_reponse id INT AUTO_INCREMENT NOT NULL, CHANGE id_question id_question_id INT NOT NULL, CHANGE correcte is_correcte TINYINT(1) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC3536353B48 FOREIGN KEY (id_question_id) REFERENCES question (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C7CDC3536353B48 ON proposition (id_question_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question MODIFY id_question INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY question_chapitre1_FK
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY question_difficulte2_FK
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY question_type_FK
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY question_utilisateur0_FK
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX question_type_FK ON question
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX question_utilisateur0_FK ON question
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX question_chapitre1_FK ON question
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX question_difficulte2_FK ON question
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON question
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD type_question_id INT NOT NULL, ADD difficulte_id INT NOT NULL, ADD question_utilisateur_id INT NOT NULL, ADD chapitre_id INT NOT NULL, DROP id_type, DROP mail, DROP id_chapitre, DROP id_difficulte, CHANGE image image VARCHAR(512) DEFAULT NULL, CHANGE id_question id INT AUTO_INCREMENT NOT NULL, CHANGE active is_active TINYINT(1) NOT NULL
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
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B6F7494E553E212E ON question (type_question_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B6F7494EE6357589 ON question (difficulte_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B6F7494E13A874B6 ON question (question_utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B6F7494E1FBEEF7B ON question (chapitre_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme MODIFY id_theme INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON theme
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme CHANGE contenu contenu VARCHAR(255) NOT NULL, CHANGE id_theme id INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type MODIFY id_type INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON type
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type CHANGE id_type id INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD id INT AUTO_INCREMENT NOT NULL, ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD photo VARCHAR(512) DEFAULT NULL, ADD nb_questions INT NOT NULL, ADD nb_eval INT NOT NULL, DROP mail, DROP mdp, DROP photo_de_profil, DROP nbr_question, DROP nbr_eval, CHANGE nom nom VARCHAR(100) NOT NULL, CHANGE prenom prenom VARCHAR(100) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON utilisateur (email)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE contient (id_question INT NOT NULL, id_evaluation INT NOT NULL, INDEX contient_evaluation0_FK (id_evaluation), INDEX IDX_DC302E56E62CA5DB (id_question), PRIMARY KEY(id_question, id_evaluation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE theme_chapitre (id_chapitre INT NOT NULL, id_theme INT NOT NULL, INDEX theme_chapitre_theme0_FK (id_theme), INDEX IDX_2E5CA252DCB95CB0 (id_chapitre), PRIMARY KEY(id_chapitre, id_theme)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contient ADD CONSTRAINT contient_evaluation0_FK FOREIGN KEY (id_evaluation) REFERENCES evaluation (id_evaluation) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contient ADD CONSTRAINT contient_question_FK FOREIGN KEY (id_question) REFERENCES question (id_question) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme_chapitre ADD CONSTRAINT theme_chapitre_chapitre_FK FOREIGN KEY (id_chapitre) REFERENCES chapitre (id_chapitre) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme_chapitre ADD CONSTRAINT theme_chapitre_theme0_FK FOREIGN KEY (id_theme) REFERENCES theme (id_theme) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation_question DROP FOREIGN KEY FK_BBB93068456C5646
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation_question DROP FOREIGN KEY FK_BBB930681E27F6BF
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE evaluation_question
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur MODIFY id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_IDENTIFIER_EMAIL ON utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD mail VARCHAR(128) NOT NULL COMMENT 'RFC 3696', ADD mdp VARCHAR(256) NOT NULL, ADD photo_de_profil VARCHAR(512) NOT NULL, ADD nbr_question INT NOT NULL, ADD nbr_eval INT NOT NULL, DROP id, DROP email, DROP roles, DROP password, DROP photo, DROP nb_questions, DROP nb_eval, CHANGE nom nom VARCHAR(64) NOT NULL, CHANGE prenom prenom VARCHAR(64) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD PRIMARY KEY (mail)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre MODIFY id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre DROP FOREIGN KEY FK_8C62B02559027487
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8C62B02559027487 ON chapitre
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON chapitre
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre DROP theme_id, CHANGE contenu contenu VARCHAR(256) NOT NULL, CHANGE id id_chapitre INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE chapitre ADD PRIMARY KEY (id_chapitre)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type MODIFY id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON type
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type CHANGE id id_type INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE type ADD PRIMARY KEY (id_type)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE difficulte MODIFY id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON difficulte
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE difficulte CHANGE id id_difficulte INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE difficulte ADD PRIMARY KEY (id_difficulte)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question MODIFY id INT NOT NULL
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
            DROP INDEX IDX_B6F7494E553E212E ON question
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_B6F7494EE6357589 ON question
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_B6F7494E13A874B6 ON question
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_B6F7494E1FBEEF7B ON question
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON question
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD id_type INT NOT NULL, ADD mail VARCHAR(128) NOT NULL COMMENT 'RFC 3696', ADD id_chapitre INT DEFAULT NULL, ADD id_difficulte INT NOT NULL, DROP type_question_id, DROP difficulte_id, DROP question_utilisateur_id, DROP chapitre_id, CHANGE image image VARCHAR(512) NOT NULL, CHANGE id id_question INT AUTO_INCREMENT NOT NULL, CHANGE is_active active TINYINT(1) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT question_chapitre1_FK FOREIGN KEY (id_chapitre) REFERENCES chapitre (id_chapitre) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT question_difficulte2_FK FOREIGN KEY (id_difficulte) REFERENCES difficulte (id_difficulte) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT question_type_FK FOREIGN KEY (id_type) REFERENCES type (id_type) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT question_utilisateur0_FK FOREIGN KEY (mail) REFERENCES utilisateur (mail) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX question_type_FK ON question (id_type)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX question_utilisateur0_FK ON question (mail)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX question_chapitre1_FK ON question (id_chapitre)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX question_difficulte2_FK ON question (id_difficulte)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD PRIMARY KEY (id_question)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition MODIFY id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC3536353B48
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_C7CDC3536353B48 ON proposition
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON proposition
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition CHANGE contenu contenu TEXT NOT NULL, CHANGE id id_reponse INT AUTO_INCREMENT NOT NULL, CHANGE id_question_id id_question INT NOT NULL, CHANGE is_correcte correcte TINYINT(1) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition ADD CONSTRAINT proposition_question_FK FOREIGN KEY (id_question) REFERENCES question (id_question) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX proposition_question_FK ON proposition (id_question)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proposition ADD PRIMARY KEY (id_reponse)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation MODIFY id INT NOT NULL
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
            DROP INDEX IDX_1323A5758C585DA7 ON evaluation
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1323A575C9ADC5C1 ON evaluation
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1323A575ADAC3987 ON evaluation
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON evaluation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD mail VARCHAR(128) NOT NULL COMMENT 'RFC 3696', ADD id_theme INT NOT NULL, ADD id_difficulte INT NOT NULL, ADD calculatrice TINYINT(1) NOT NULL, ADD ordinateur TINYINT(1) NOT NULL, ADD documents TINYINT(1) NOT NULL, ADD active TINYINT(1) NOT NULL, DROP theme_eval_id, DROP difficulte_eval_id, DROP evaluation_utilisateur_id, DROP is_calculatrice, DROP is_ordinateur, DROP is_document, DROP is_active, CHANGE autre_modalite autre_modalite VARCHAR(256) NOT NULL, CHANGE introduction introduction VARCHAR(256) NOT NULL, CHANGE id id_evaluation INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD CONSTRAINT evaluation_difficulte1_FK FOREIGN KEY (id_difficulte) REFERENCES difficulte (id_difficulte) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD CONSTRAINT evaluation_theme0_FK FOREIGN KEY (id_theme) REFERENCES theme (id_theme) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD CONSTRAINT evaluation_utilisateur_FK FOREIGN KEY (mail) REFERENCES utilisateur (mail) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX evaluation_utilisateur_FK ON evaluation (mail)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX evaluation_theme0_FK ON evaluation (id_theme)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX evaluation_difficulte1_FK ON evaluation (id_difficulte)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evaluation ADD PRIMARY KEY (id_evaluation)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme MODIFY id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON theme
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme CHANGE contenu contenu VARCHAR(256) NOT NULL, CHANGE id id_theme INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE theme ADD PRIMARY KEY (id_theme)
        SQL);
    }
}
