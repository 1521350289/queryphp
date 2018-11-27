<?php

declare(strict_types=1);

/*
 * This file is part of the forcodepoem package.
 *
 * The PHP Application Created By Code Poem. <Query Yet Simple>
 * (c) 2018-2099 http://forcodepoem.com All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Admin\App\Service\Permission;

use Common\Domain\Entity\Permission;
use Leevel\Collection\Collection;
use Leevel\Database\Ddd\IUnitOfWork;
use Leevel\Kernel\HandleException;

/**
 * 批量修改权限状态.
 *
 * @author Name Your <your@mail.com>
 *
 * @since 2017.10.23
 *
 * @version 1.0
 */
class Status
{
    /**
     * 事务工作单元.
     *
     * @var \Leevel\Database\Ddd\IUnitOfWork
     */
    protected $w;

    /**
     * 构造函数.
     *
     * @param \Leevel\Database\Ddd\IUnitOfWork $w
     */
    public function __construct(IUnitOfWork $w)
    {
        $this->w = $w;
    }

    /**
     * 响应方法.
     *
     * @param array $input
     *
     * @return array
     */
    public function handle(array $input): array
    {
        $this->save($this->findAll($input), $input['status']);

        return [];
    }

    /**
     * 保存状态
     *
     * @param \Leevel\Collection\Collection $resources
     * @param string                        $status
     */
    protected function save(Collection $resources, string $status)
    {
        foreach ($resources as $resource) {
            $resource->status = $status;
            $this->w->persist($resource);
        }

        $this->w->flush();
    }

    /**
     * 查询符合条件的权限.
     *
     * @param array $input
     *
     * @return \Leevel\Collection\Collection
     */
    protected function findAll(array $input): Collection
    {
        $resources = $this->w->repository(Permission::class)->

        findAll(function ($select) use ($input) {
            $select->whereIn('id', $input['ids']);
        });

        if (0 === count($resources)) {
            throw new HandleException(__('未发现权限'));
        }

        return $resources;
    }
}