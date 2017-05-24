<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170523082413 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE `user` (
              `id` int(11) NOT NULL PRIMARY KEY,
              `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE KEY,
              `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
            )');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
