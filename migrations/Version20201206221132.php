<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206221132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE promos (id INT AUTO_INCREMENT NOT NULL, referentiels_id INT DEFAULT NULL, langue VARCHAR(100) NOT NULL, titre VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, lieu VARCHAR(255) DEFAULT NULL, avatar LONGBLOB DEFAULT NULL, fabrique VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin_provisoire DATE NOT NULL, date_fin_reel DATE DEFAULT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_31D1F705B8F4689C (referentiels_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promos_formateur (promos_id INT NOT NULL, formateur_id INT NOT NULL, INDEX IDX_70F76221CAA392D2 (promos_id), INDEX IDX_70F76221155D8F51 (formateur_id), PRIMARY KEY(promos_id, formateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promos ADD CONSTRAINT FK_31D1F705B8F4689C FOREIGN KEY (referentiels_id) REFERENCES referentiels (id)');
        $this->addSql('ALTER TABLE promos_formateur ADD CONSTRAINT FK_70F76221CAA392D2 FOREIGN KEY (promos_id) REFERENCES promos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promos_formateur ADD CONSTRAINT FK_70F76221155D8F51 FOREIGN KEY (formateur_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupes ADD promos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE groupes ADD CONSTRAINT FK_576366D9CAA392D2 FOREIGN KEY (promos_id) REFERENCES promos (id)');
        $this->addSql('CREATE INDEX IDX_576366D9CAA392D2 ON groupes (promos_id)');
        $this->addSql('ALTER TABLE user ADD promos_id INT DEFAULT NULL, CHANGE isdeleted isdeleted INT DEFAULT NULL, CHANGE isconnect isconnect INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CAA392D2 FOREIGN KEY (promos_id) REFERENCES promos (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649CAA392D2 ON user (promos_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupes DROP FOREIGN KEY FK_576366D9CAA392D2');
        $this->addSql('ALTER TABLE promos_formateur DROP FOREIGN KEY FK_70F76221CAA392D2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CAA392D2');
        $this->addSql('DROP TABLE promos');
        $this->addSql('DROP TABLE promos_formateur');
        $this->addSql('DROP INDEX IDX_576366D9CAA392D2 ON groupes');
        $this->addSql('ALTER TABLE groupes DROP promos_id');
        $this->addSql('DROP INDEX IDX_8D93D649CAA392D2 ON user');
        $this->addSql('ALTER TABLE user DROP promos_id, CHANGE isdeleted isdeleted INT NOT NULL, CHANGE isconnect isconnect INT NOT NULL');
    }
}
