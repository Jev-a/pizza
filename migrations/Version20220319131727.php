<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220319131727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create tables ingredients, pizzes, ingredient_pizza';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP table if exists ingredients');
        $this->addSql('DROP table if exists pizzes');
        $this->addSql('DROP table if exists ingredient_pizza');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, short_name VARCHAR(70) NOT NULL, price NUMERIC(4, 2) NOT NULL, title VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_pizza (ingredient_id INT NOT NULL, pizza_id INT NOT NULL, INDEX IDX_D6EFE5AE933FE08C (ingredient_id), INDEX IDX_D6EFE5AED41D1D42 (pizza_id), PRIMARY KEY(ingredient_id, pizza_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizzes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(70) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ingredient_pizza ADD CONSTRAINT FK_D6EFE5AE933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_pizza ADD CONSTRAINT FK_D6EFE5AED41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizzes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient_pizza DROP FOREIGN KEY FK_D6EFE5AE933FE08C');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_pizza');
        $this->addSql('DROP TABLE pizzes');
        $this->addSql('DROP TABLE ingredients');
    }
}
