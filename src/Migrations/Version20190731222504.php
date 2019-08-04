<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190731222504 extends AbstractMigration
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
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, beer_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, email VARCHAR(100) NOT NULL, weight NUMERIC(4, 1) DEFAULT NULL, name VARCHAR(100) NOT NULL, number_beer INT DEFAULT NULL, INDEX IDX_C7440455D0989053 (beer_id), INDEX IDX_C7440455BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_beer ADD CONSTRAINT FK_2FDFE1FABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_beer ADD CONSTRAINT FK_2FDFE1FAD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455D0989053 FOREIGN KEY (beer_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE beer ADD client_id INT DEFAULT NULL, ADD beer_id INT DEFAULT NULL, CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE beer ADD CONSTRAINT FK_58F666AD19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE beer ADD CONSTRAINT FK_58F666ADD0989053 FOREIGN KEY (beer_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_58F666AD19EB6921 ON beer (client_id)');
        $this->addSql('CREATE INDEX IDX_58F666ADD0989053 ON beer (beer_id)');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer DROP FOREIGN KEY FK_58F666AD19EB6921');
        $this->addSql('ALTER TABLE beer DROP FOREIGN KEY FK_58F666ADD0989053');
        $this->addSql('DROP TABLE categorie_beer');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP INDEX IDX_58F666AD19EB6921 ON beer');
        $this->addSql('DROP INDEX IDX_58F666ADD0989053 ON beer');
        $this->addSql('ALTER TABLE beer DROP client_id, DROP beer_id, CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
