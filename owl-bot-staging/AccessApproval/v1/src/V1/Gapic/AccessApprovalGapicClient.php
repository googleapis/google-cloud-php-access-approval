<?php
/*
 * Copyright 2022 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * Generated by gapic-generator-php from the file
 * https://github.com/googleapis/googleapis/blob/master/google/cloud/accessapproval/v1/accessapproval.proto
 * Updates to the above are reflected here through a refresh process.
 */

namespace Google\Cloud\AccessApproval\V1\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;

use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\RequestParamsHeaderDescriptor;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\AccessApproval\V1\AccessApprovalSettings;
use Google\Cloud\AccessApproval\V1\ApprovalRequest;
use Google\Cloud\AccessApproval\V1\ApproveApprovalRequestMessage;
use Google\Cloud\AccessApproval\V1\DeleteAccessApprovalSettingsMessage;
use Google\Cloud\AccessApproval\V1\DismissApprovalRequestMessage;
use Google\Cloud\AccessApproval\V1\GetAccessApprovalSettingsMessage;
use Google\Cloud\AccessApproval\V1\GetApprovalRequestMessage;
use Google\Cloud\AccessApproval\V1\ListApprovalRequestsMessage;
use Google\Cloud\AccessApproval\V1\ListApprovalRequestsResponse;
use Google\Cloud\AccessApproval\V1\UpdateAccessApprovalSettingsMessage;
use Google\Protobuf\FieldMask;
use Google\Protobuf\GPBEmpty;
use Google\Protobuf\Timestamp;

/**
 * Service Description: This API allows a customer to manage accesses to cloud resources by
 * Google personnel. It defines the following resource model:
 *
 * - The API has a collection of
 * [ApprovalRequest][google.cloud.accessapproval.v1.ApprovalRequest]
 * resources, named `approvalRequests/{approval_request_id}`
 * - The API has top-level settings per Project/Folder/Organization, named
 * `accessApprovalSettings`
 *
 * The service also periodically emails a list of recipients, defined at the
 * Project/Folder/Organization level in the accessApprovalSettings, when there
 * is a pending ApprovalRequest for them to act on. The ApprovalRequests can
 * also optionally be published to a Cloud Pub/Sub topic owned by the customer
 * (for Beta, the Pub/Sub setup is managed manually).
 *
 * ApprovalRequests can be approved or dismissed. Google personel can only
 * access the indicated resource or resources if the request is approved
 * (subject to some exclusions:
 * https://cloud.google.com/access-approval/docs/overview#exclusions).
 *
 * Note: Using Access Approval functionality will mean that Google may not be
 * able to meet the SLAs for your chosen products, as any support response times
 * may be dramatically increased. As such the SLAs do not apply to any service
 * disruption to the extent impacted by Customer's use of Access Approval. Do
 * not enable Access Approval for projects where you may require high service
 * availability and rapid response by Google Cloud Support.
 *
 * After a request is approved or dismissed, no further action may be taken on
 * it. Requests with the requested_expiration in the past or with no activity
 * for 14 days are considered dismissed. When an approval expires, the request
 * is considered dismissed.
 *
 * If a request is not approved or dismissed, we call it pending.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $accessApprovalClient = new AccessApprovalClient();
 * try {
 *     $response = $accessApprovalClient->approveApprovalRequest();
 * } finally {
 *     $accessApprovalClient->close();
 * }
 * ```
 */
class AccessApprovalGapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.cloud.accessapproval.v1.AccessApproval';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'accessapproval.googleapis.com';

    /**
     * The default port of the service.
     */
    const DEFAULT_SERVICE_PORT = 443;

    /**
     * The name of the code generator, to be included in the agent header.
     */
    const CODEGEN_NAME = 'gapic';

    /**
     * The default scopes required by the service.
     */
    public static $serviceScopes = [
        'https://www.googleapis.com/auth/cloud-platform',
    ];

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'serviceAddress' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__ . '/../resources/access_approval_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../resources/access_approval_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../resources/access_approval_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../resources/access_approval_rest_client_config.php',
                ],
            ],
        ];
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *     Optional. Options for configuring the service API wrapper.
     *
     *     @type string $serviceAddress
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'accessapproval.googleapis.com:443'.
     *     @type string|array|FetchAuthTokenInterface|CredentialsWrapper $credentials
     *           The credentials to be used by the client to authorize API calls. This option
     *           accepts either a path to a credentials file, or a decoded credentials file as a
     *           PHP array.
     *           *Advanced usage*: In addition, this option can also accept a pre-constructed
     *           {@see \Google\Auth\FetchAuthTokenInterface} object or
     *           {@see \Google\ApiCore\CredentialsWrapper} object. Note that when one of these
     *           objects are provided, any settings in $credentialsConfig will be ignored.
     *     @type array $credentialsConfig
     *           Options used to configure credentials, including auth token caching, for the
     *           client. For a full list of supporting configuration options, see
     *           {@see \Google\ApiCore\CredentialsWrapper::build()} .
     *     @type bool $disableRetries
     *           Determines whether or not retries defined by the client configuration should be
     *           disabled. Defaults to `false`.
     *     @type string|array $clientConfig
     *           Client method configuration, including retry settings. This option can be either
     *           a path to a JSON file, or a PHP array containing the decoded JSON data. By
     *           default this settings points to the default client config file, which is
     *           provided in the resources folder.
     *     @type string|TransportInterface $transport
     *           The transport used for executing network requests. May be either the string
     *           `rest` or `grpc`. Defaults to `grpc` if gRPC support is detected on the system.
     *           *Advanced usage*: Additionally, it is possible to pass in an already
     *           instantiated {@see \Google\ApiCore\Transport\TransportInterface} object. Note
     *           that when this object is provided, any settings in $transportConfig, and any
     *           $serviceAddress setting, will be ignored.
     *     @type array $transportConfig
     *           Configuration options that will be used to construct the transport. Options for
     *           each supported transport type should be passed in a key for that transport. For
     *           example:
     *           $transportConfig = [
     *               'grpc' => [...],
     *               'rest' => [...],
     *           ];
     *           See the {@see \Google\ApiCore\Transport\GrpcTransport::build()} and
     *           {@see \Google\ApiCore\Transport\RestTransport::build()} methods for the
     *           supported options.
     *     @type callable $clientCertSource
     *           A callable which returns the client cert as a string. This can be used to
     *           provide a certificate and private key to the transport layer for mTLS.
     * }
     *
     * @throws ValidationException
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
    }

    /**
     * Approves a request and returns the updated ApprovalRequest.
     *
     * Returns NOT_FOUND if the request does not exist. Returns
     * FAILED_PRECONDITION if the request exists but is not in a pending state.
     *
     * Sample code:
     * ```
     * $accessApprovalClient = new AccessApprovalClient();
     * try {
     *     $response = $accessApprovalClient->approveApprovalRequest();
     * } finally {
     *     $accessApprovalClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $name
     *           Name of the approval request to approve.
     *     @type Timestamp $expireTime
     *           The expiration time of this approval.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\AccessApproval\V1\ApprovalRequest
     *
     * @throws ApiException if the remote call fails
     */
    public function approveApprovalRequest(array $optionalArgs = [])
    {
        $request = new ApproveApprovalRequestMessage();
        $requestParamHeaders = [];
        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        if (isset($optionalArgs['expireTime'])) {
            $request->setExpireTime($optionalArgs['expireTime']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('ApproveApprovalRequest', ApprovalRequest::class, $optionalArgs, $request)->wait();
    }

    /**
     * Deletes the settings associated with a project, folder, or organization.
     * This will have the effect of disabling Access Approval for the project,
     * folder, or organization, but only if all ancestors also have Access
     * Approval disabled. If Access Approval is enabled at a higher level of the
     * hierarchy, then Access Approval will still be enabled at this level as
     * the settings are inherited.
     *
     * Sample code:
     * ```
     * $accessApprovalClient = new AccessApprovalClient();
     * try {
     *     $accessApprovalClient->deleteAccessApprovalSettings();
     * } finally {
     *     $accessApprovalClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $name
     *           Name of the AccessApprovalSettings to delete.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @throws ApiException if the remote call fails
     */
    public function deleteAccessApprovalSettings(array $optionalArgs = [])
    {
        $request = new DeleteAccessApprovalSettingsMessage();
        $requestParamHeaders = [];
        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('DeleteAccessApprovalSettings', GPBEmpty::class, $optionalArgs, $request)->wait();
    }

    /**
     * Dismisses a request. Returns the updated ApprovalRequest.
     *
     * NOTE: This does not deny access to the resource if another request has been
     * made and approved. It is equivalent in effect to ignoring the request
     * altogether.
     *
     * Returns NOT_FOUND if the request does not exist.
     *
     * Returns FAILED_PRECONDITION if the request exists but is not in a pending
     * state.
     *
     * Sample code:
     * ```
     * $accessApprovalClient = new AccessApprovalClient();
     * try {
     *     $response = $accessApprovalClient->dismissApprovalRequest();
     * } finally {
     *     $accessApprovalClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $name
     *           Name of the ApprovalRequest to dismiss.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\AccessApproval\V1\ApprovalRequest
     *
     * @throws ApiException if the remote call fails
     */
    public function dismissApprovalRequest(array $optionalArgs = [])
    {
        $request = new DismissApprovalRequestMessage();
        $requestParamHeaders = [];
        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('DismissApprovalRequest', ApprovalRequest::class, $optionalArgs, $request)->wait();
    }

    /**
     * Gets the settings associated with a project, folder, or organization.
     *
     * Sample code:
     * ```
     * $accessApprovalClient = new AccessApprovalClient();
     * try {
     *     $response = $accessApprovalClient->getAccessApprovalSettings();
     * } finally {
     *     $accessApprovalClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $name
     *           Name of the AccessApprovalSettings to retrieve.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\AccessApproval\V1\AccessApprovalSettings
     *
     * @throws ApiException if the remote call fails
     */
    public function getAccessApprovalSettings(array $optionalArgs = [])
    {
        $request = new GetAccessApprovalSettingsMessage();
        $requestParamHeaders = [];
        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetAccessApprovalSettings', AccessApprovalSettings::class, $optionalArgs, $request)->wait();
    }

    /**
     * Gets an approval request. Returns NOT_FOUND if the request does not exist.
     *
     * Sample code:
     * ```
     * $accessApprovalClient = new AccessApprovalClient();
     * try {
     *     $response = $accessApprovalClient->getApprovalRequest();
     * } finally {
     *     $accessApprovalClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $name
     *           Name of the approval request to retrieve.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\AccessApproval\V1\ApprovalRequest
     *
     * @throws ApiException if the remote call fails
     */
    public function getApprovalRequest(array $optionalArgs = [])
    {
        $request = new GetApprovalRequestMessage();
        $requestParamHeaders = [];
        if (isset($optionalArgs['name'])) {
            $request->setName($optionalArgs['name']);
            $requestParamHeaders['name'] = $optionalArgs['name'];
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('GetApprovalRequest', ApprovalRequest::class, $optionalArgs, $request)->wait();
    }

    /**
     * Lists approval requests associated with a project, folder, or organization.
     * Approval requests can be filtered by state (pending, active, dismissed).
     * The order is reverse chronological.
     *
     * Sample code:
     * ```
     * $accessApprovalClient = new AccessApprovalClient();
     * try {
     *     // Iterate over pages of elements
     *     $pagedResponse = $accessApprovalClient->listApprovalRequests();
     *     foreach ($pagedResponse->iteratePages() as $page) {
     *         foreach ($page as $element) {
     *             // doSomethingWith($element);
     *         }
     *     }
     *     // Alternatively:
     *     // Iterate through all elements
     *     $pagedResponse = $accessApprovalClient->listApprovalRequests();
     *     foreach ($pagedResponse->iterateAllElements() as $element) {
     *         // doSomethingWith($element);
     *     }
     * } finally {
     *     $accessApprovalClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type string $parent
     *           The parent resource. This may be "projects/{project_id}",
     *           "folders/{folder_id}", or "organizations/{organization_id}".
     *     @type string $filter
     *           A filter on the type of approval requests to retrieve. Must be one of the
     *           following values:
     *
     *           - [not set]: Requests that are pending or have active approvals.
     *           - ALL: All requests.
     *           - PENDING: Only pending requests.
     *           - ACTIVE: Only active (i.e. currently approved) requests.
     *           - DISMISSED: Only dismissed (including expired) requests.
     *
     *     @type int $pageSize
     *           The maximum number of resources contained in the underlying API
     *           response. The API may return fewer values in a page, even if
     *           there are additional values to be retrieved.
     *     @type string $pageToken
     *           A page token is used to specify a page of values to be returned.
     *           If no page token is specified (the default), the first page
     *           of values will be returned. Any page token used here must have
     *           been generated by a previous call to the API.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\PagedListResponse
     *
     * @throws ApiException if the remote call fails
     */
    public function listApprovalRequests(array $optionalArgs = [])
    {
        $request = new ListApprovalRequestsMessage();
        $requestParamHeaders = [];
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
            $requestParamHeaders['parent'] = $optionalArgs['parent'];
        }

        if (isset($optionalArgs['filter'])) {
            $request->setFilter($optionalArgs['filter']);
        }

        if (isset($optionalArgs['pageSize'])) {
            $request->setPageSize($optionalArgs['pageSize']);
        }

        if (isset($optionalArgs['pageToken'])) {
            $request->setPageToken($optionalArgs['pageToken']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->getPagedListResponse('ListApprovalRequests', $optionalArgs, ListApprovalRequestsResponse::class, $request);
    }

    /**
     * Updates the settings associated with a project, folder, or organization.
     * Settings to update are determined by the value of field_mask.
     *
     * Sample code:
     * ```
     * $accessApprovalClient = new AccessApprovalClient();
     * try {
     *     $response = $accessApprovalClient->updateAccessApprovalSettings();
     * } finally {
     *     $accessApprovalClient->close();
     * }
     * ```
     *
     * @param array $optionalArgs {
     *     Optional.
     *
     *     @type AccessApprovalSettings $settings
     *           The new AccessApprovalSettings.
     *     @type FieldMask $updateMask
     *           The update mask applies to the settings. Only the top level fields of
     *           AccessApprovalSettings (notification_emails & enrolled_services) are
     *           supported. For each field, if it is included, the currently stored value
     *           will be entirely overwritten with the value of the field passed in this
     *           request.
     *
     *           For the `FieldMask` definition, see
     *           https://developers.google.com/protocol-buffers/docs/reference/google.protobuf#fieldmask
     *           If this field is left unset, only the notification_emails field will be
     *           updated.
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a
     *           {@see Google\ApiCore\RetrySettings} object, or an associative array of retry
     *           settings parameters. See the documentation on
     *           {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\AccessApproval\V1\AccessApprovalSettings
     *
     * @throws ApiException if the remote call fails
     */
    public function updateAccessApprovalSettings(array $optionalArgs = [])
    {
        $request = new UpdateAccessApprovalSettingsMessage();
        $requestParamHeaders = [];
        if (isset($optionalArgs['settings'])) {
            $request->setSettings($optionalArgs['settings']);
        }

        if (isset($optionalArgs['updateMask'])) {
            $request->setUpdateMask($optionalArgs['updateMask']);
        }

        $requestParams = new RequestParamsHeaderDescriptor($requestParamHeaders);
        $optionalArgs['headers'] = isset($optionalArgs['headers']) ? array_merge($requestParams->getHeader(), $optionalArgs['headers']) : $requestParams->getHeader();
        return $this->startCall('UpdateAccessApprovalSettings', AccessApprovalSettings::class, $optionalArgs, $request)->wait();
    }
}
