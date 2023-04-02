<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107201453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classifier_okei (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(255) NOT NULL, position_key INT NOT NULL, group_id INT NOT NULL, group_name VARCHAR(255) NOT NULL, section_name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nomenclature (id INT AUTO_INCREMENT NOT NULL, nomenclature_type_id INT DEFAULT NULL, unit_id INT DEFAULT NULL, nomenclature_name VARCHAR(255) NOT NULL, nomenclature_articul VARCHAR(255) NOT NULL, nomenclature_guid VARCHAR(255) NOT NULL, INDEX IDX_799A3652258BBEA6 (nomenclature_type_id), INDEX IDX_799A3652F8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nomenclature_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_recipe (id INT AUTO_INCREMENT NOT NULL, production_type_id INT DEFAULT NULL, recipe_name VARCHAR(255) NOT NULL, INDEX IDX_1528256AD059014E (production_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_recipe_arguments (id INT AUTO_INCREMENT NOT NULL, recipe_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, recipe_argument_guid VARCHAR(255) NOT NULL, recipe_argument_id VARCHAR(255) NOT NULL, INDEX IDX_A79C0FEC69574A48 (recipe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_recipe_content (id INT AUTO_INCREMENT NOT NULL, production_recipe_section_id INT DEFAULT NULL, nomenclature_id INT DEFAULT NULL, postion_argument DOUBLE PRECISION NOT NULL, postion_formula VARCHAR(255) NOT NULL, INDEX IDX_15DCE435AD150ADE (production_recipe_section_id), INDEX IDX_15DCE43590BFD4B8 (nomenclature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_recipe_structure (id INT AUTO_INCREMENT NOT NULL, structure_name VARCHAR(255) NOT NULL, structure_ordering INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nomenclature ADD CONSTRAINT FK_799A3652258BBEA6 FOREIGN KEY (nomenclature_type_id) REFERENCES nomenclature_type (id)');
        $this->addSql('ALTER TABLE nomenclature ADD CONSTRAINT FK_799A3652F8BD700D FOREIGN KEY (unit_id) REFERENCES classifier_okei (id)');
        $this->addSql('ALTER TABLE production_recipe ADD CONSTRAINT FK_1528256AD059014E FOREIGN KEY (production_type_id) REFERENCES production_type (id)');
        $this->addSql('ALTER TABLE production_recipe_arguments ADD CONSTRAINT FK_A79C0FEC69574A48 FOREIGN KEY (recipe_id_id) REFERENCES production_recipe (id)');
        $this->addSql('ALTER TABLE production_recipe_content ADD CONSTRAINT FK_15DCE435AD150ADE FOREIGN KEY (production_recipe_section_id) REFERENCES production_recipe_structure (id)');
        $this->addSql('ALTER TABLE production_recipe_content ADD CONSTRAINT FK_15DCE43590BFD4B8 FOREIGN KEY (nomenclature_id) REFERENCES nomenclature (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nomenclature DROP FOREIGN KEY FK_799A3652258BBEA6');
        $this->addSql('ALTER TABLE nomenclature DROP FOREIGN KEY FK_799A3652F8BD700D');
        $this->addSql('ALTER TABLE production_recipe DROP FOREIGN KEY FK_1528256AD059014E');
        $this->addSql('ALTER TABLE production_recipe_arguments DROP FOREIGN KEY FK_A79C0FEC69574A48');
        $this->addSql('ALTER TABLE production_recipe_content DROP FOREIGN KEY FK_15DCE435AD150ADE');
        $this->addSql('ALTER TABLE production_recipe_content DROP FOREIGN KEY FK_15DCE43590BFD4B8');
        $this->addSql('DROP TABLE classifier_okei');
        $this->addSql('DROP TABLE nomenclature');
        $this->addSql('DROP TABLE nomenclature_type');
        $this->addSql('DROP TABLE production_recipe');
        $this->addSql('DROP TABLE production_recipe_arguments');
        $this->addSql('DROP TABLE production_recipe_content');
        $this->addSql('DROP TABLE production_recipe_structure');
        $this->addSql('DROP TABLE production_type');
    }
}
