<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190804025439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE beer_user (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, beer_id_id INT DEFAULT NULL, note VARCHAR(100) DEFAULT NULL, degree NUMERIC(3, 1) DEFAULT NULL, INDEX IDX_85678D949D86650F (user_id_id), INDEX IDX_85678D94872EC465 (beer_id_id), UNIQUE INDEX user_beer_relation_unique (note, degree), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_beer (categorie_id INT NOT NULL, beer_id INT NOT NULL, INDEX IDX_2FDFE1FABCF5E72D (categorie_id), INDEX IDX_2FDFE1FAD0989053 (beer_id), PRIMARY KEY(categorie_id, beer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beer_user ADD CONSTRAINT FK_85678D949D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE beer_user ADD CONSTRAINT FK_85678D94872EC465 FOREIGN KEY (beer_id_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE categorie_beer ADD CONSTRAINT FK_2FDFE1FABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_beer ADD CONSTRAINT FK_2FDFE1FAD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beer CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL, CHANGE beer_id beer_id INT DEFAULT NULL, CHANGE client_new_id client_new_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL, CHANGE degree degree NUMERIC(3, 1) DEFAULT NULL, CHANGE note note VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer_user DROP FOREIGN KEY FK_85678D949D86650F');
        $this->addSql('DROP TABLE beer_user');
        $this->addSql('DROP TABLE categorie_beer');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE beer CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL, CHANGE beer_id beer_id INT DEFAULT NULL, CHANGE client_new_id client_new_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT \'NULL\', CHANGE degree degree NUMERIC(3, 1) DEFAULT \'NULL\', CHANGE note note VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE categorie CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
