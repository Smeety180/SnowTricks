<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230420083105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD user_id INT NOT NULL, ADD figure_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC5C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCA76ED395 ON commentaire (user_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC5C011B5 ON commentaire (figure_id)');
        $this->addSql('ALTER TABLE figure ADD categorie_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37ABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2F57B37ABCF5E72D ON figure (categorie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2F57B37AA76ED395 ON figure (user_id)');
        $this->addSql('ALTER TABLE image ADD figure_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F5C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F5C011B5 ON image (figure_id)');
        $this->addSql('ALTER TABLE video ADD figure_id INT NOT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C5C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CC7DA2C5C011B5 ON video (figure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC5C011B5');
        $this->addSql('DROP INDEX IDX_67F068BCA76ED395 ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BC5C011B5 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP user_id, DROP figure_id');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C5C011B5');
        $this->addSql('DROP INDEX UNIQ_7CC7DA2C5C011B5 ON video');
        $this->addSql('ALTER TABLE video DROP figure_id');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37ABCF5E72D');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AA76ED395');
        $this->addSql('DROP INDEX UNIQ_2F57B37ABCF5E72D ON figure');
        $this->addSql('DROP INDEX UNIQ_2F57B37AA76ED395 ON figure');
        $this->addSql('ALTER TABLE figure DROP categorie_id, DROP user_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F5C011B5');
        $this->addSql('DROP INDEX UNIQ_C53D045F5C011B5 ON image');
        $this->addSql('ALTER TABLE image DROP figure_id');
    }
}
