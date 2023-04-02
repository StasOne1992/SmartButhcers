<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104224601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, executor_id INT DEFAULT NULL, INDEX IDX_D3EDB1E08ABD09BB (executor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production_recipe (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, recipe_name VARCHAR(255) NOT NULL, recipe_param LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', recipe_content LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', recipe_available TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productionrecipesection (id INT AUTO_INCREMENT NOT NULL, recipe_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, order_pos INT NOT NULL, INDEX IDX_400BB36569574A48 (recipe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe_content (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, name VARCHAR(255) NOT NULL, formula VARCHAR(255) DEFAULT NULL, havechild TINYINT(1) NOT NULL, parent INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, postion_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, middlename VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649DA81E3CC (postion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E08ABD09BB FOREIGN KEY (executor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE productionrecipesection ADD CONSTRAINT FK_400BB36569574A48 FOREIGN KEY (recipe_id_id) REFERENCES production_recipe (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DA81E3CC FOREIGN KEY (postion_id) REFERENCES position (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E08ABD09BB');
        $this->addSql('ALTER TABLE productionrecipesection DROP FOREIGN KEY FK_400BB36569574A48');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DA81E3CC');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE production');
        $this->addSql('DROP TABLE production_recipe');
        $this->addSql('DROP TABLE productionrecipesection');
        $this->addSql('DROP TABLE recipe_content');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
