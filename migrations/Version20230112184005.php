<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112184005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nomenclature DROP FOREIGN KEY FK_799A3652258BBEA6');
        $this->addSql('CREATE TABLE nomenclature_types (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE nomenclature_type');
        $this->addSql('DROP INDEX IDX_799A3652258BBEA6 ON nomenclature');
        $this->addSql('ALTER TABLE nomenclature CHANGE nomenclature_type_id nomenclature_types_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nomenclature ADD CONSTRAINT FK_799A3652D8E13046 FOREIGN KEY (nomenclature_types_id) REFERENCES nomenclature_types (id)');
        $this->addSql('CREATE INDEX IDX_799A3652D8E13046 ON nomenclature (nomenclature_types_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nomenclature DROP FOREIGN KEY FK_799A3652D8E13046');
        $this->addSql('CREATE TABLE nomenclature_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE nomenclature_types');
        $this->addSql('DROP INDEX IDX_799A3652D8E13046 ON nomenclature');
        $this->addSql('ALTER TABLE nomenclature CHANGE nomenclature_types_id nomenclature_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nomenclature ADD CONSTRAINT FK_799A3652258BBEA6 FOREIGN KEY (nomenclature_type_id) REFERENCES nomenclature_type (id)');
        $this->addSql('CREATE INDEX IDX_799A3652258BBEA6 ON nomenclature (nomenclature_type_id)');
    }
}
