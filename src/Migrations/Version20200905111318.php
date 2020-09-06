<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200905111318 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE accum_cost (id INT AUTO_INCREMENT NOT NULL, recorder_invoice_id INT DEFAULT NULL, recorder_order_id INT DEFAULT NULL, product_id INT NOT NULL, period DATETIME NOT NULL, recorder INT DEFAULT NULL, record_kind SMALLINT DEFAULT NULL, quantity NUMERIC(10, 3) NOT NULL, cost NUMERIC(10, 2) NOT NULL, INDEX IDX_6F3EEDF383D48C68 (recorder_invoice_id), INDEX IDX_6F3EEDF3D4E0264C (recorder_order_id), INDEX IDX_6F3EEDF34584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE accum_cost_total (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, period DATETIME NOT NULL, quantity NUMERIC(10, 3) NOT NULL, cost NUMERIC(10, 2) NOT NULL, INDEX IDX_582A66944584665A (product_id), UNIQUE INDEX dimensions_idx (period, product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accum_cost ADD CONSTRAINT FK_6F3EEDF383D48C68 FOREIGN KEY (recorder_invoice_id) REFERENCES doc_invoice (id)');
        $this->addSql('ALTER TABLE accum_cost ADD CONSTRAINT FK_6F3EEDF3D4E0264C FOREIGN KEY (recorder_order_id) REFERENCES doc_order (id)');
        $this->addSql('ALTER TABLE accum_cost ADD CONSTRAINT FK_6F3EEDF34584665A FOREIGN KEY (product_id) REFERENCES ref_product (id)');
        $this->addSql('ALTER TABLE accum_cost_total ADD CONSTRAINT FK_582A66944584665A FOREIGN KEY (product_id) REFERENCES ref_product (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE accum_cost');
        $this->addSql('DROP TABLE accum_cost_total');
    }
}
