<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413202326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE user_selling_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_selling_item (id INT NOT NULL, user_id INT NOT NULL, selling_item_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7D02548FA76ED395 ON user_selling_item (user_id)');
        $this->addSql('CREATE INDEX IDX_7D02548FAE2D0C03 ON user_selling_item (selling_item_id)');
        $this->addSql('ALTER TABLE user_selling_item ADD CONSTRAINT FK_7D02548FA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_selling_item ADD CONSTRAINT FK_7D02548FAE2D0C03 FOREIGN KEY (selling_item_id) REFERENCES selling_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE selling_item DROP CONSTRAINT fk_fdce288d44e55a94');
        $this->addSql('DROP INDEX idx_fdce288d44e55a94');
        $this->addSql('ALTER TABLE selling_item DROP user_ref_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE user_selling_item_id_seq CASCADE');
        $this->addSql('ALTER TABLE user_selling_item DROP CONSTRAINT FK_7D02548FA76ED395');
        $this->addSql('ALTER TABLE user_selling_item DROP CONSTRAINT FK_7D02548FAE2D0C03');
        $this->addSql('DROP TABLE user_selling_item');
        $this->addSql('ALTER TABLE selling_item ADD user_ref_id INT NOT NULL');
        $this->addSql('ALTER TABLE selling_item ADD CONSTRAINT fk_fdce288d44e55a94 FOREIGN KEY (user_ref_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fdce288d44e55a94 ON selling_item (user_ref_id)');
    }
}
