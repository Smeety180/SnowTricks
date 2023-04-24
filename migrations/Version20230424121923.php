<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230424121923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE figure DROP INDEX UNIQ_2F57B37ABCF5E72D, ADD INDEX IDX_2F57B37ABCF5E72D (categorie_id)');
        $this->addSql('ALTER TABLE figure DROP INDEX UNIQ_2F57B37AA76ED395, ADD INDEX IDX_2F57B37AA76ED395 (user_id)');
        $this->addSql('ALTER TABLE image DROP INDEX UNIQ_C53D045F5C011B5, ADD INDEX IDX_C53D045F5C011B5 (figure_id)');
        $this->addSql('ALTER TABLE video DROP INDEX UNIQ_7CC7DA2C5C011B5, ADD INDEX IDX_7CC7DA2C5C011B5 (figure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video DROP INDEX IDX_7CC7DA2C5C011B5, ADD UNIQUE INDEX UNIQ_7CC7DA2C5C011B5 (figure_id)');
        $this->addSql('ALTER TABLE image DROP INDEX IDX_C53D045F5C011B5, ADD UNIQUE INDEX UNIQ_C53D045F5C011B5 (figure_id)');
        $this->addSql('ALTER TABLE figure DROP INDEX IDX_2F57B37AA76ED395, ADD UNIQUE INDEX UNIQ_2F57B37AA76ED395 (user_id)');
        $this->addSql('ALTER TABLE figure DROP INDEX IDX_2F57B37ABCF5E72D, ADD UNIQUE INDEX UNIQ_2F57B37ABCF5E72D (categorie_id)');
    }
}
