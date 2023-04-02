<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230116232544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE production_recipe_content_production_recipe (production_recipe_content_id INT NOT NULL, production_recipe_id INT NOT NULL, INDEX IDX_B0907AF0F1964A49 (production_recipe_content_id), INDEX IDX_B0907AF0FE47F3CE (production_recipe_id), PRIMARY KEY(production_recipe_content_id, production_recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE production_recipe_content_production_recipe ADD CONSTRAINT FK_B0907AF0F1964A49 FOREIGN KEY (production_recipe_content_id) REFERENCES production_recipe_content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE production_recipe_content_production_recipe ADD CONSTRAINT FK_B0907AF0FE47F3CE FOREIGN KEY (production_recipe_id) REFERENCES production_recipe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production_recipe_content_production_recipe DROP FOREIGN KEY FK_B0907AF0F1964A49');
        $this->addSql('ALTER TABLE production_recipe_content_production_recipe DROP FOREIGN KEY FK_B0907AF0FE47F3CE');
        $this->addSql('DROP TABLE production_recipe_content_production_recipe');
    }
}
