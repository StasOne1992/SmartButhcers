<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107183659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE productionrecipesection DROP FOREIGN KEY FK_400BB36569574A48');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E08ABD09BB');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0FE47F3CE');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E012469DE2');
        $this->addSql('DROP TABLE recipe_content');
        $this->addSql('DROP TABLE production_recipe');
        $this->addSql('DROP TABLE productionrecipesection');
        $this->addSql('DROP TABLE production');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipe_content (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, formula VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, havechild TINYINT(1) NOT NULL, parent INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE production_recipe (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, recipe_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, recipe_param LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', recipe_content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', recipe_available TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE productionrecipesection (id INT AUTO_INCREMENT NOT NULL, recipe_id_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, order_pos INT NOT NULL, INDEX IDX_400BB36569574A48 (recipe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, executor_id INT DEFAULT NULL, category_id INT DEFAULT NULL, production_recipe_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_D3EDB1E08ABD09BB (executor_id), INDEX IDX_D3EDB1E012469DE2 (category_id), INDEX IDX_D3EDB1E0FE47F3CE (production_recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE productionrecipesection ADD CONSTRAINT FK_400BB36569574A48 FOREIGN KEY (recipe_id_id) REFERENCES production_recipe (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E08ABD09BB FOREIGN KEY (executor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0FE47F3CE FOREIGN KEY (production_recipe_id) REFERENCES production_recipe (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E012469DE2 FOREIGN KEY (category_id) REFERENCES production_category (id)');
    }
}
