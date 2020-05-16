<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516073903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE projet_competence (projet_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_15498055C18272 (projet_id), INDEX IDX_1549805515761DAB (competence_id), PRIMARY KEY(projet_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_competence (user_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_33B3AE93A76ED395 (user_id), INDEX IDX_33B3AE9315761DAB (competence_id), PRIMARY KEY(user_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere_ecole (filiere_id INT NOT NULL, ecole_id INT NOT NULL, INDEX IDX_7028280A180AA129 (filiere_id), INDEX IDX_7028280A77EF1B1E (ecole_id), PRIMARY KEY(filiere_id, ecole_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet_competence ADD CONSTRAINT FK_15498055C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_competence ADD CONSTRAINT FK_1549805515761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_competence ADD CONSTRAINT FK_33B3AE93A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_competence ADD CONSTRAINT FK_33B3AE9315761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere_ecole ADD CONSTRAINT FK_7028280A180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere_ecole ADD CONSTRAINT FK_7028280A77EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9A76ED395 ON projet (user_id)');
        $this->addSql('ALTER TABLE user ADD ecole_id INT NOT NULL, ADD filiere_id INT NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP mot_de_passe, DROP role, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64977EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE INDEX IDX_8D93D64977EF1B1E ON user (ecole_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649180AA129 ON user (filiere_id)');
        $this->addSql('ALTER TABLE competence ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687FA21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_94D4687FA21214B7 ON competence (categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE projet_competence');
        $this->addSql('DROP TABLE user_competence');
        $this->addSql('DROP TABLE filiere_ecole');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687FA21214B7');
        $this->addSql('DROP INDEX IDX_94D4687FA21214B7 ON competence');
        $this->addSql('ALTER TABLE competence DROP categories_id');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9A76ED395');
        $this->addSql('DROP INDEX IDX_50159CA9A76ED395 ON projet');
        $this->addSql('ALTER TABLE projet DROP user_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64977EF1B1E');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649180AA129');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX IDX_8D93D64977EF1B1E ON user');
        $this->addSql('DROP INDEX IDX_8D93D649180AA129 ON user');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP ecole_id, DROP filiere_id, DROP roles, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
