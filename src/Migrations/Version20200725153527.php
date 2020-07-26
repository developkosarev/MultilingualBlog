<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200725153527 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accum_stock (id INT AUTO_INCREMENT NOT NULL, invoice_id INT DEFAULT NULL, product_id INT NOT NULL, warehouse_id INT NOT NULL, period DATETIME NOT NULL, quantity NUMERIC(10, 3) NOT NULL, reserved_quantity NUMERIC(10, 3) NOT NULL, INDEX IDX_DBFE53882989F1FD (invoice_id), INDEX IDX_DBFE53884584665A (product_id), INDEX IDX_DBFE53885080ECDE (warehouse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doc_order (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, version INT DEFAULT 1 NOT NULL, marked TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accum_stock ADD CONSTRAINT FK_DBFE53882989F1FD FOREIGN KEY (invoice_id) REFERENCES doc_invoice (id)');
        $this->addSql('ALTER TABLE accum_stock ADD CONSTRAINT FK_DBFE53884584665A FOREIGN KEY (product_id) REFERENCES ref_product (id)');
        $this->addSql('ALTER TABLE accum_stock ADD CONSTRAINT FK_DBFE53885080ECDE FOREIGN KEY (warehouse_id) REFERENCES ref_warehouse (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE accum_stock');
        $this->addSql('DROP TABLE doc_order');
    }
}
