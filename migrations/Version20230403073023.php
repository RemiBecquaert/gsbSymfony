<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403073023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_frais DROP INDEX UNIQ_5FC0A6A7C6EE5C49, ADD INDEX IDX_5FC0A6A7C6EE5C49 (id_utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_frais DROP INDEX IDX_5FC0A6A7C6EE5C49, ADD UNIQUE INDEX UNIQ_5FC0A6A7C6EE5C49 (id_utilisateur_id)');
    }
}
