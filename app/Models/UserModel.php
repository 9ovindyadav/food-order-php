<?php

declare(strict_types=1);

namespace APP\Models ;

use App\Model ;

class UserModel extends Model
{
    public function create(string $name, string $email, string $role = 'counter_staff', bool $isActive = true ): int
    {
        if($name && $email){
            $password = 'admin';
            $password = $this->hashPassword($password);

            $statement = $this->db->prepare('INSERT INTO users ( name, email, password, role, is_active, updated_at, created_at) VALUES( :name, :email, :password, :role,:isActive ,NOW(),NOW() )');

            $statement->execute([':name' => $name,':email' => $email, ':password' => $password, ':isActive' => $isActive, ':role' => $role]);

            return (int) $this->db->lastInsertId() ;
        }

        return 0 ;
    }

    public function findById(int $userId): array
    {
        $statement = $this->db->prepare('SELECT id,name, email, role, is_active, password FROM users WHERE id = ?');

        $statement->execute([$userId]);
        $user = $statement->fetch();
        if(!$user){
            throw new \Exception('User not found');
        }

        return $user ;
    }

    public function findByEmail(string $email): array
    {
        $statement = $this->db->prepare('SELECT id,name, email, role, is_active, password FROM users WHERE email = ?');

        $statement->execute([$email]);
        $user = $statement->fetch();
        if(!$user){
            throw new \Exception('User not found');
        }

        return $user ;
    }

    public function update(int $userId,string $name, string $email,string $role ,bool $isActive = true ): bool
    {
        if($userId && $name && $email && $role){
            $statement = $this->db->prepare('UPDATE users SET name = ? , email = ?, role = ? , is_active = ? , updated_at = NOW() WHERE id = ? ');

            $statement->execute([$name, $email, $role, $isActive, $userId]);

            return true ;
        }
        return false ;
    }

    public function delete(int $userId): bool
    {
        $statement = $this->db->prepare('DELETE FROM users WHERE id = ?');

        $statement->execute([$userId]);
        
        return true ;
    }

    public function getAll(): array
    {
        $statement = $this->db->prepare('SELECT id, name, email, is_active ,role, updated_at,created_at FROM users');

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
        $user = $this->findByEmail($email);

        if(!password_verify($password, $user['password'])){
            throw new \Exception('Wrong Password');
        }
        if($user && password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['authenticated'] = true ;            
            return true ;
        }
    }

    public function isAuthenticated():bool
    {
        return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ;
    }
}