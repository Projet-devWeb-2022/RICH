<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331125446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_3EC63EAAA6E44244 ON destination');
        $this->addSql('ALTER TABLE destination DROP pays_id');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAACD33232C FOREIGN KEY (contry_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE order_recap ADD CONSTRAINT FK_AC2469DD4AFD4C8C FOREIGN KEY (order_rattached_id) REFERENCES `orders` (id)');
        $this->addSql('ALTER TABLE orders ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEA76ED395 ON orders (user_id)');
        $this->addSql('ALTER TABLE orders_prestation ADD CONSTRAINT FK_340A962ACFFE9AD6 FOREIGN KEY (orders_id) REFERENCES `orders` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_prestation ADD CONSTRAINT FK_340A962A9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack ADD CONSTRAINT FK_97DE5E23816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE pack_prestation ADD CONSTRAINT FK_73A007BB1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pack_prestation ADD CONSTRAINT FK_73A007BB9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation CHANGE vehicle_id vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('ALTER TABLE prestation_destination ADD CONSTRAINT FK_6C7AE39B9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_destination ADD CONSTRAINT FK_6C7AE39B816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAACD33232C');
        $this->addSql('ALTER TABLE destination ADD pays_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_3EC63EAAA6E44244 ON destination (pays_id)');
        $this->addSql('ALTER TABLE order_recap DROP FOREIGN KEY FK_AC2469DD4AFD4C8C');
        $this->addSql('ALTER TABLE `orders` DROP FOREIGN KEY FK_E52FFDEE1919B217');
        $this->addSql('ALTER TABLE `orders` DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('DROP INDEX IDX_E52FFDEEA76ED395 ON `orders`');
        $this->addSql('ALTER TABLE `orders` DROP user_id');
        $this->addSql('ALTER TABLE orders_prestation DROP FOREIGN KEY FK_340A962ACFFE9AD6');
        $this->addSql('ALTER TABLE orders_prestation DROP FOREIGN KEY FK_340A962A9E45C554');
        $this->addSql('ALTER TABLE pack DROP FOREIGN KEY FK_97DE5E23816C6140');
        $this->addSql('ALTER TABLE pack_prestation DROP FOREIGN KEY FK_73A007BB1919B217');
        $this->addSql('ALTER TABLE pack_prestation DROP FOREIGN KEY FK_73A007BB9E45C554');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD545317D1');
        $this->addSql('ALTER TABLE prestation CHANGE vehicle_id vehicle_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation_destination DROP FOREIGN KEY FK_6C7AE39B9E45C554');
        $this->addSql('ALTER TABLE prestation_destination DROP FOREIGN KEY FK_6C7AE39B816C6140');
    }
}
