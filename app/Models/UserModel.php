<?php

declare(strict_types=1);

namespace APP\Models ;

use App\Model ;

class UserModel extends Model
{
    public function create(string $name, string $email, bool $isActive = true ): int
    {
        $password = 'admin';
        $password = $this->hashPassword($password);

        $statement = $this->db-prepare('INSERT INTO users( name, email, is_active, created_at) VALUES( ?, ?, ?, ?, NOW() )');

        $statement->execute([$name, $email, $password, $isActive]);

        return (int) $this->db->lastInsertId() ;
    }

    public function find(int $userId): array
    {
        $statement = $this->db->prepare('SELECT name, email, is_active FROM users WHERE id = ?');

        $statement->execute([$userId]);
        $user = $statement->fetch();

        return $user ?? [] ;
    }

    public function update(string $name, string $email ,bool $isActive = true ): int
    {
        $statement = $this->db-prepare('UPDATE users SET name = ? , email = ? , is_active = ? , updated_at = NOW() ');

        $statement->execute([$name, $email, $isActive]);

        return (int) $this->db->lastInsertId() ;
    }

    public function delete(int $userId): bool
    {
        $statement = $this->db->prepare('DELETE FROM users WHERE id = ?');

        $statement->execute([$userId]);
        
        return true ;
    }

    public function getAll(): array
    {
        $statement = $this->db->prepare('SELECT id, name, email, is_active, updated_at FROM users');

        $statement->execute();
        $users = $statement->fetchAll();

        return $users ?? [] ;
    }

    public function updatePassword(int $userId, string $newPassword): bool
    {
        $newPassword = $this->hashPassword($newPassword);

        $statement = $this->db->prepare('UPDATE users SET password = ? , updated_at = NOW()  WHERE id = ? ');

        $statement->execute([$newPassword, $userId]);

        return true ;
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT,['cost' => 12]);
    }

    public function authenticate(string $email, string $password): bool
    {
        $user = $this->getUSerByEmail($email);

        if($user && password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['authenticated'] = true ;
            
            return true;
        }
        
        return false;
    }

    public function isAuthenticated():bool
    {
        return isset($_SESSION['authenticate']) && $_SESSION['authenticate'] === true ;
    }
}