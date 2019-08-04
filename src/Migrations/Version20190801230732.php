<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190801230732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL, CHANGE beer_id beer_id INT DEFAULT NULL, CHANGE client_new_id client_new_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL, CHANGE degree degree NUMERIC(3, 1) DEFAULT NULL, CHANGE note note VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE client_id client_id INT DEFAULT NULL, CHANGE beer_id beer_id INT DEFAULT NULL, CHANGE client_new_id client_new_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT \'NULL\', CHANGE degree degree NUMERIC(2, 1) DEFAULT \'NULL\', CHANGE note note VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE categorie CHANGE client_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
