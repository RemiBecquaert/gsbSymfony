<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405201521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64979F37AE5');
        $this->addSql('DROP INDEX UNIQ_8D93D64979F37AE5 ON user');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(30) NOT NULL, ADD prenom VARCHAR(30) NOT NULL, ADD adresse VARCHAR(50) NOT NULL, ADD cp VARCHAR(5) NOT NULL, ADD ville VARCHAR(30) NOT NULL, ADD date_embauche DATE NOT NULL, DROP id_user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD id_user_id INT NOT NULL, DROP nom, DROP prenom, DROP adresse, DROP cp, DROP ville, DROP date_embauche');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64979F37AE5 FOREIGN KEY (id_user_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64979F37AE5 ON user (id_user_id)');
    }
}
