<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200726183448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE doc_invoice_product (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, product_id INT NOT NULL, quantity NUMERIC(10, 3) NOT NULL, price NUMERIC(10, 2) NOT NULL, sum NUMERIC(10, 2) NOT NULL, line_no INT NOT NULL, INDEX IDX_D9D4A0C47E3C61F9 (owner_id), INDEX IDX_D9D4A0C44584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE doc_invoice_product ADD CONSTRAINT FK_D9D4A0C47E3C61F9 FOREIGN KEY (owner_id) REFERENCES doc_invoice (id)');
        $this->addSql('ALTER TABLE doc_invoice_product ADD CONSTRAINT FK_D9D4A0C44584665A FOREIGN KEY (product_id) REFERENCES ref_product (id)');
        $this->addSql('ALTER TABLE accum_stock ADD order_id INT DEFAULT NULL, ADD recorder INT NOT NULL, ADD record_kind SMALLINT NOT NULL, CHANGE invoice_id invoice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accum_stock ADD CONSTRAINT FK_DBFE53888D9F6D38 FOREIGN KEY (order_id) REFERENCES doc_order (id)');
        $this->addSql('CREATE INDEX IDX_DBFE53888D9F6D38 ON accum_stock (order_id)');
        $this->addSql('ALTER TABLE doc_invoice ADD total_sum NUMERIC(10, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE doc_invoice_product');
        $this->addSql('ALTER TABLE accum_stock DROP FOREIGN KEY FK_DBFE53888D9F6D38');
        $this->addSql('DROP INDEX IDX_DBFE53888D9F6D38 ON accum_stock');
        $this->addSql('ALTER TABLE accum_stock DROP order_id, DROP recorder, DROP record_kind, CHANGE invoice_id invoice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE doc_invoice DROP total_sum');
    }
}
