<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260414140354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_plateforme (article_id INT NOT NULL, plateforme_id INT NOT NULL, PRIMARY KEY (article_id, plateforme_id))');
        $this->addSql('CREATE INDEX IDX_DBDD907294869C ON article_plateforme (article_id)');
        $this->addSql('CREATE INDEX IDX_DBDD90391E226B ON article_plateforme (plateforme_id)');
        $this->addSql('ALTER TABLE article_plateforme ADD CONSTRAINT FK_DBDD907294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_plateforme ADD CONSTRAINT FK_DBDD90391E226B FOREIGN KEY (plateforme_id) REFERENCES plateforme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD usr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD cat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C69D3FB FOREIGN KEY (usr_id) REFERENCES "user" (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66E6ADA943 FOREIGN KEY (cat_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66C69D3FB ON article (usr_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66E6ADA943 ON article (cat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_plateforme DROP CONSTRAINT FK_DBDD907294869C');
        $this->addSql('ALTER TABLE article_plateforme DROP CONSTRAINT FK_DBDD90391E226B');
        $this->addSql('DROP TABLE article_plateforme');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66C69D3FB');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66E6ADA943');
        $this->addSql('DROP INDEX IDX_23A0E66C69D3FB');
        $this->addSql('DROP INDEX IDX_23A0E66E6ADA943');
        $this->addSql('ALTER TABLE article DROP usr_id');
        $this->addSql('ALTER TABLE article DROP cat_id');
    }
}
