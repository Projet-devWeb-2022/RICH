<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315235339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, pack_id INT DEFAULT NULL, amount INT NOT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_F52993981919B217 (pack_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_prestation (order_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_E21272F88D9F6D38 (order_id), INDEX IDX_E21272F89E45C554 (prestation_id), PRIMARY KEY(order_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_recap (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, amount INT NOT NULL, paiment_method VARCHAR(255) NOT NULL, facturation_adress VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, continent VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, vehicule_id INT NOT NULL, vehicle_id INT NOT NULL, label VARCHAR(255) NOT NULL, price INT NOT NULL, is_available TINYINT(1) NOT NULL, img JSON DEFAULT NULL, description VARCHAR(255) NOT NULL, nb_people_max INT NOT NULL, prestationType VARCHAR(255) NOT NULL, type_of_stay VARCHAR(255) DEFAULT NULL, check_in DATE DEFAULT NULL, check_out DATE DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, airport_departure VARCHAR(255) DEFAULT NULL, airport_arrival VARCHAR(255) DEFAULT NULL, date_departure VARCHAR(255) DEFAULT NULL, date_arrival DATE DEFAULT NULL, type_vehicul VARCHAR(255) DEFAULT NULL, pick_up_date DATE DEFAULT NULL, drop_off_date DATE DEFAULT NULL, pick_up_location VARCHAR(255) DEFAULT NULL, type_activity VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, adress_activity VARCHAR(255) DEFAULT NULL, INDEX IDX_51C88FAD4A4A3511 (vehicule_id), INDEX IDX_51C88FAD545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, nb_people_max INT NOT NULL, price_day INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE order_prestation ADD CONSTRAINT FK_E21272F88D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_prestation ADD CONSTRAINT FK_E21272F89E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE destination DROP pays, DROP continent_pays');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E23816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_prestation DROP FOREIGN KEY FK_E21272F88D9F6D38');
        $this->addSql('ALTER TABLE order_prestation DROP FOREIGN KEY FK_E21272F89E45C554');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD4A4A3511');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD545317D1');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_prestation');
        $this->addSql('DROP TABLE order_recap');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE vehicle');
        $this->addSql('ALTER TABLE destination ADD pays VARCHAR(65) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD continent_pays VARCHAR(55) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E23816C6140');
    }
}
