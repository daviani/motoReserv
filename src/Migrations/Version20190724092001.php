<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190724092001 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bike_tag (bike_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_B5850758D5A4816F (bike_id), INDEX IDX_B5850758BAD26311 (tag_id), PRIMARY KEY(bike_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bike_owner (id INT AUTO_INCREMENT NOT NULL, bike_id INT DEFAULT NULL, gender SMALLINT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, bith_date VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL, UNIQUE INDEX UNIQ_66CDFF28D5A4816F (bike_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, gender SMALLINT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, bith_date VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, bike_id INT NOT NULL, customer_id INT NOT NULL, tack_date DATETIME NOT NULL, created_at DATETIME NOT NULL, status SMALLINT NOT NULL, INDEX IDX_42C84955D5A4816F (bike_id), INDEX IDX_42C849559395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bike_tag ADD CONSTRAINT FK_B5850758D5A4816F FOREIGN KEY (bike_id) REFERENCES bike (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bike_tag ADD CONSTRAINT FK_B5850758BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bike_owner ADD CONSTRAINT FK_66CDFF28D5A4816F FOREIGN KEY (bike_id) REFERENCES bike (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D5A4816F FOREIGN KEY (bike_id) REFERENCES bike (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559395C3F3');
        $this->addSql('ALTER TABLE bike_tag DROP FOREIGN KEY FK_B5850758BAD26311');
        $this->addSql('DROP TABLE bike_tag');
        $this->addSql('DROP TABLE bike_owner');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE tag');
    }
}
