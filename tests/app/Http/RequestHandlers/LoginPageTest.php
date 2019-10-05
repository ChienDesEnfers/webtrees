<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2019 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace Fisharebest\Webtrees\Http\RequestHandlers;

use Fisharebest\Webtrees\TestCase;
use Fisharebest\Webtrees\User;
use Fisharebest\Webtrees\View;

/**
 * @covers \Fisharebest\Webtrees\Http\RequestHandlers\LoginPage
 */
class LoginPageTest extends TestCase
{
    /**
     * @return void
     */
    public function testLoginPage(): void
    {
        View::share('tree', null);
        $request  = self::createRequest();
        $handler  = new LoginPage();
        $response = $handler->handle($request);

        self::assertSame(self::STATUS_OK, $response->getStatusCode());
    }

    /**
     * @return void
     */
    public function testLoginPageAlreadyLoggedIn(): void
    {
        $user     = $this->createMock(User::class);
        $request  = self::createRequest()->withAttribute('user', $user);
        $handler  = new LoginPage();
        $response = $handler->handle($request);

        self::assertSame(self::STATUS_FOUND, $response->getStatusCode());
    }
}
