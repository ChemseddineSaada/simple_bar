<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726221815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer CHANGE published_at published_at DATETIME DEFAULT NULL, CHANGE country_id_id country_id_id INT DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE beer ADD CONSTRAINT FK_58F666ADD8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_58F666ADD8A48BBD ON beer (country_id_id)');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE beer DROP FOREIGN KEY FK_58F666ADD8A48BBD');
        $this->addSql('DROP INDEX IDX_58F666ADD8A48BBD ON beer');
        $this->addSql('ALTER TABLE beer DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE beer CHANGE country_id_id country_id_id INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE country CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE address address VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
