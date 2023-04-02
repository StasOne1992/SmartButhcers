<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107201722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production_recipe_structure ADD production_recipe_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production_recipe_structure ADD CONSTRAINT FK_334B0F282A5918C9 FOREIGN KEY (production_recipe_id_id) REFERENCES production_recipe (id)');
        $this->addSql('CREATE INDEX IDX_334B0F282A5918C9 ON production_recipe_structure (production_recipe_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production_recipe_structure DROP FOREIGN KEY FK_334B0F282A5918C9');
        $this->addSql('DROP INDEX IDX_334B0F282A5918C9 ON production_recipe_structure');
        $this->addSql('ALTER TABLE production_recipe_structure DROP production_recipe_id_id');
    }
}
