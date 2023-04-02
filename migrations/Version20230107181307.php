<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107181307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production ADD production_recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0FE47F3CE FOREIGN KEY (production_recipe_id) REFERENCES production_recipe (id)');
        $this->addSql('CREATE INDEX IDX_D3EDB1E0FE47F3CE ON production (production_recipe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0FE47F3CE');
        $this->addSql('DROP INDEX IDX_D3EDB1E0FE47F3CE ON production');
        $this->addSql('ALTER TABLE production DROP production_recipe_id');
    }
}
