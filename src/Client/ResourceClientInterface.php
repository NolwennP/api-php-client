<?php

namespace Akeneo\Pim\Client;

use Akeneo\Pim\Exception\HttpException;
use Psr\Http\Message\StreamInterface;

/**
 * Generic client interface to execute common request on resources.
 *
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
interface ResourceClientInterface
{
    /**
     * Gets a resource.
     *
     * @param string $uri             URI of the resource
     * @param array  $uriParameters   URI parameters of the resource
     * @param array  $queryParameters Query parameters of the request
     *
     * @throws HttpException
     *
     * @return array
     */
    public function getResource($uri, array $uriParameters = [], array $queryParameters = []);

    /**
     * Gets a list of resources.
     *
     * @param string   $uri             URI of the resource
     * @param array    $uriParameters   URI parameters of the resource
     * @param int      $limit           The maximum number of resources to return.
     *                                  Do note that the server has a default value if you don't specify anything.
     *                                  The server has a maximum limit allowed as well.
     * @param bool     $withCount       Set to true to return the total count of resources.
     *                                  This parameter could decrease drastically the performance when set to true.
     * @param array    $queryParameters Additional query parameters of the request
     *
     * @throws \InvalidArgumentException
     * @throws HttpException
     *
     * @return array
     */
    public function getResources($uri, array $uriParameters = [], $limit = 10, $withCount = false, array $queryParameters = []);

    /**
     * Creates a resource.
     *
     * @param string $uri           URI of the resource
     * @param array  $uriParameters URI parameters of the resource
     * @param array  $body          Body of the request
     *
     * @throws HttpException
     *
     * @return int status code of the response to know if the resource has been created (code 201)
     */
    public function createResource($uri, array $uriParameters = [], array $body = []);

    /**
     * Creates a resource using a multipart request.
     *
     * @param string $uri           URI of the resource
     * @param array  $uriParameters URI parameters of the resources
     * @param array  $requestParts  Parts of the request. Each part is defined with "name", "contents", and "options"
     *
     * @throws HttpException
     *
     * @return int status code of the response to know if the resource has been created (code 201)
     */
    public function createMultipartResource($uri, array $uriParameters = [], array $requestParts = []);

    /**
     * Creates a resource if it does not exist yet, otherwise updates partially the resource.
     *
     * @param string $uri           URI of the resource
     * @param array  $uriParameters URI parameters of the resource
     * @param array  $body          Body of the request
     *
     * @throws HttpException
     *
     * @return int status code of the response to know if the resource has been created (code 201) or updated (code 204)
     */
    public function upsertResource($uri, array $uriParameters = [], array $body = []);

    /**
     * Updates or creates several resources.
     *
     * @param string             $uri           URI of the resource
     * @param array              $uriParameters URI parameters of the resource
     * @param array|\Traversable $resources     array of resources to create or update
     *
     * @throws HttpException
     *
     * @return \Traversable returns an iterable object, each entry corresponding to the response of the upserted resource
     */
    public function upsertResourceList($uri, array $uriParameters = [], $resources = []);

    /**
     * Deletes a resource.
     *
     * @param string $uri           URI of the resource to delete
     * @param array  $uriParameters URI parameters of the resource
     *
     * @throws HttpException
     *
     * @return int Status code 204 indicating that the resource has been well deleted
     */
    public function deleteResource($uri, array $uriParameters = []);

    /**
     * Gets a streamed resource.
     *
     * @param string $uri           URI of the resource
     * @param array  $uriParameters URI parameters of the resource
     *
     * @throws HttpException
     *
     * @return StreamInterface
     */
    public function getStreamedResource($uri, array $uriParameters = []);
}
