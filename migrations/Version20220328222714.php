<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328222714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, type_of_activity VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, continent VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, contry_id INT NOT NULL, city VARCHAR(255) NOT NULL, details VARCHAR(1000) DEFAULT NULL, INDEX IDX_3EC63EAAA6E44244 (pays_id), INDEX IDX_3EC63EAACD33232C (contry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, check_in_date DATETIME NOT NULL, check_out_time DATETIME NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, pack_id INT DEFAULT NULL, date_of_order DATETIME NOT NULL, ammount DOUBLE PRECISION NOT NULL, INDEX IDX_F52993981919B217 (pack_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_prestation (order_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_E21272F88D9F6D38 (order_id), INDEX IDX_E21272F89E45C554 (prestation_id), PRIMARY KEY(order_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_recap (id INT AUTO_INCREMENT NOT NULL, order_rattached_id INT NOT NULL, transaction_type VARCHAR(255) NOT NULL, billing_adress VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AC2469DD4AFD4C8C (order_rattached_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack (id INT AUTO_INCREMENT NOT NULL, destination_id INT NOT NULL, name VARCHAR(255) NOT NULL, image LONGBLOB DEFAULT NULL, description VARCHAR(1000) NOT NULL, price DOUBLE PRECISION DEFAULT NULL, nb_person_max INT NOT NULL, INDEX IDX_97DE5E23816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack_prestation (pack_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_73A007BB1919B217 (pack_id), INDEX IDX_73A007BB9E45C554 (prestation_id), PRIMARY KEY(pack_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, is_available TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(1000) NOT NULL, nb_person_max INT NOT NULL, image LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT NOT NULL, airport_departure VARCHAR(255) NOT NULL, date_departure DATE NOT NULL, departure_time TIME NOT NULL, airport_arrival VARCHAR(255) NOT NULL, arrival_time TIME NOT NULL, date_arrival DATE NOT NULL, INDEX IDX_2D0B6BCE545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, price_day DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_rental (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT NOT NULL, picking_address VARCHAR(255) NOT NULL, pick_up_date DATETIME NOT NULL, drop_off_date DATETIME NOT NULL, INDEX IDX_BFC7C3AE545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAAA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAACD33232C FOREIGN KEY (contry_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE order_prestation ADD CONSTRAINT FK_E21272F88D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_prestation ADD CONSTRAINT FK_E21272F89E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_recap ADD CONSTRAINT FK_AC2469DD4AFD4C8C FOREIGN KEY (order_rattached_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E23816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE pack_prestation ADD CONSTRAINT FK_73A007BB1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack_prestation ADD CONSTRAINT FK_73A007BB9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCE545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE vehicle_rental ADD CONSTRAINT FK_BFC7C3AE545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAACD33232C');
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E23816C6140');
        $this->addSql('ALTER TABLE order_prestation DROP FOREIGN KEY FK_E21272F88D9F6D38');
        $this->addSql('ALTER TABLE order_recap DROP FOREIGN KEY FK_AC2469DD4AFD4C8C');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981919B217');
        $this->addSql('ALTER TABLE pack_prestation DROP FOREIGN KEY FK_73A007BB1919B217');
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAAA6E44244');
        $this->addSql('ALTER TABLE order_prestation DROP FOREIGN KEY FK_E21272F89E45C554');
        $this->addSql('ALTER TABLE pack_prestation DROP FOREIGN KEY FK_73A007BB9E45C554');
        $this->addSql('ALTER TABLE travel DROP FOREIGN KEY FK_2D0B6BCE545317D1');
        $this->addSql('ALTER TABLE vehicle_rental DROP FOREIGN KEY FK_BFC7C3AE545317D1');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_prestation');
        $this->addSql('DROP TABLE order_recap');
        $this->addSql('DROP TABLE pack');
        $this->addSql('DROP TABLE pack_prestation');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE travel');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('DROP TABLE vehicle_rental');
    }
}
