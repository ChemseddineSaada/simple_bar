<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190804025732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie_beer (categorie_id INT NOT NULL, beer_id INT NOT NULL, INDEX IDX_2FDFE1FABCF5E72D (categorie_id), INDEX IDX_2FDFE1FAD0989053 (beer_id), PRIMARY KEY(categorie_id, beer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_beer ADD CONSTRAINT FK_2FDFE1FABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_beer ADD CONSTRAINT FK_2FDFE1FAD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beer CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL, CHANGE beer_id beer_id INT DEFAULT NULL, CHANGE client_new_id client_new_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL, CHANGE degree degree NUMERIC(3, 1) DEFAULT NULL, CHANGE note note VARCHAR(100) DEFAULT NULL');
        $this->addSql('DROP INDEX user_beer_relation_unique ON beer_user');
        $this->addSql('ALTER TABLE beer_user CHANGE user_id_id user_id_id INT DEFAULT NULL, CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE note note VARCHAR(100) DEFAULT NULL, CHANGE degree degree NUMERIC(3, 1) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX user_beer_relation_unique ON beer_user (beer_id_id, user_id_id, note, degree)');
        $this->addSql('ALTER TABLE categorie CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE categorie_beer');
        $this->addSql('ALTER TABLE beer CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL, CHANGE beer_id beer_id INT DEFAULT NULL, CHANGE client_new_id client_new_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT \'NULL\', CHANGE degree degree NUMERIC(3, 1) DEFAULT \'NULL\', CHANGE note note VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX user_beer_relation_unique ON beer_user');
        $this->addSql('ALTER TABLE beer_user CHANGE user_id_id user_id_id INT DEFAULT NULL, CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE note note VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE degree degree NUMERIC(3, 1) DEFAULT \'NULL\'');
        $this->addSql('CREATE UNIQUE INDEX user_beer_relation_unique ON beer_user (note, degree)');
        $this->addSql('ALTER TABLE categorie CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
