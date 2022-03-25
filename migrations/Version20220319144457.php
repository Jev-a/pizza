<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220319144457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO `pizzes` (`id`, `name`) VALUES (1, "MacDac Pizza"), (2, "Lovely Mushroom Pizza");');
        $this->addSql('INSERT INTO `ingredients` (`id`, `short_name`, `title`, `price`)
                           VALUES (1, "tomato", "Tomato", 0.5),
                                  (2, "mushrooms", "Sliced mushrooms", 0.5),
                                  (3, "feta", "Feta cheese", 1.0),
                                  (4, "sausages ", "Sausages ", 1.0),
                                  (5, "onion", "Sliced onion", 0.5),
                                  (6, "mozzarella", "Mozzarella cheese", 0.3),
                                  (7, "oregano ", "Oregano ", 2.0),
                                  (8, "bacon", "Bacon ", 1.0);');
        $this->addSql('INSERT INTO `ingredient_pizza` (`pizza_id`, `ingredient_id`)
                           VALUES (1, 1),(1, 2),(1, 3),(1, 4),(1, 5),(1, 6),(1, 7),
                                  (2, 1),(2, 8),(2, 6),(2, 2),(2, 7);');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE TABLE pizzes');
        $this->addSql('TRUNCATE TABLE ingredients');
        $this->addSql('TRUNCATE TABLE ingredient_pizza');
    }
}
