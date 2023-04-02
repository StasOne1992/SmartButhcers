<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107125759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DA81E3CC');
        $this->addSql('DROP INDEX IDX_8D93D649DA81E3CC ON user');
        $this->addSql('ALTER TABLE user DROP postion_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD postion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DA81E3CC FOREIGN KEY (postion_id) REFERENCES position (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DA81E3CC ON user (postion_id)');
    }
}
