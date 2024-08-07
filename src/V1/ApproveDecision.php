<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/accessapproval/v1/accessapproval.proto

namespace Google\Cloud\AccessApproval\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A decision that has been made to approve access to a resource.
 *
 * Generated from protobuf message <code>google.cloud.accessapproval.v1.ApproveDecision</code>
 */
class ApproveDecision extends \Google\Protobuf\Internal\Message
{
    /**
     * The time at which approval was granted.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp approve_time = 1;</code>
     */
    protected $approve_time = null;
    /**
     * The time at which the approval expires.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp expire_time = 2;</code>
     */
    protected $expire_time = null;
    /**
     * If set, denotes the timestamp at which the approval is invalidated.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp invalidate_time = 3;</code>
     */
    protected $invalidate_time = null;
    /**
     * The signature for the ApprovalRequest and details on how it was signed.
     *
     * Generated from protobuf field <code>.google.cloud.accessapproval.v1.SignatureInfo signature_info = 4;</code>
     */
    protected $signature_info = null;
    /**
     * True when the request has been auto-approved.
     *
     * Generated from protobuf field <code>bool auto_approved = 5;</code>
     */
    protected $auto_approved = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Protobuf\Timestamp $approve_time
     *           The time at which approval was granted.
     *     @type \Google\Protobuf\Timestamp $expire_time
     *           The time at which the approval expires.
     *     @type \Google\Protobuf\Timestamp $invalidate_time
     *           If set, denotes the timestamp at which the approval is invalidated.
     *     @type \Google\Cloud\AccessApproval\V1\SignatureInfo $signature_info
     *           The signature for the ApprovalRequest and details on how it was signed.
     *     @type bool $auto_approved
     *           True when the request has been auto-approved.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Accessapproval\V1\Accessapproval::initOnce();
        parent::__construct($data);
    }

    /**
     * The time at which approval was granted.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp approve_time = 1;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getApproveTime()
    {
        return $this->approve_time;
    }

    public function hasApproveTime()
    {
        return isset($this->approve_time);
    }

    public function clearApproveTime()
    {
        unset($this->approve_time);
    }

    /**
     * The time at which approval was granted.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp approve_time = 1;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setApproveTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->approve_time = $var;

        return $this;
    }

    /**
     * The time at which the approval expires.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp expire_time = 2;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getExpireTime()
    {
        return $this->expire_time;
    }

    public function hasExpireTime()
    {
        return isset($this->expire_time);
    }

    public function clearExpireTime()
    {
        unset($this->expire_time);
    }

    /**
     * The time at which the approval expires.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp expire_time = 2;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setExpireTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->expire_time = $var;

        return $this;
    }

    /**
     * If set, denotes the timestamp at which the approval is invalidated.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp invalidate_time = 3;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getInvalidateTime()
    {
        return $this->invalidate_time;
    }

    public function hasInvalidateTime()
    {
        return isset($this->invalidate_time);
    }

    public function clearInvalidateTime()
    {
        unset($this->invalidate_time);
    }

    /**
     * If set, denotes the timestamp at which the approval is invalidated.
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp invalidate_time = 3;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setInvalidateTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->invalidate_time = $var;

        return $this;
    }

    /**
     * The signature for the ApprovalRequest and details on how it was signed.
     *
     * Generated from protobuf field <code>.google.cloud.accessapproval.v1.SignatureInfo signature_info = 4;</code>
     * @return \Google\Cloud\AccessApproval\V1\SignatureInfo|null
     */
    public function getSignatureInfo()
    {
        return $this->signature_info;
    }

    public function hasSignatureInfo()
    {
        return isset($this->signature_info);
    }

    public function clearSignatureInfo()
    {
        unset($this->signature_info);
    }

    /**
     * The signature for the ApprovalRequest and details on how it was signed.
     *
     * Generated from protobuf field <code>.google.cloud.accessapproval.v1.SignatureInfo signature_info = 4;</code>
     * @param \Google\Cloud\AccessApproval\V1\SignatureInfo $var
     * @return $this
     */
    public function setSignatureInfo($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AccessApproval\V1\SignatureInfo::class);
        $this->signature_info = $var;

        return $this;
    }

    /**
     * True when the request has been auto-approved.
     *
     * Generated from protobuf field <code>bool auto_approved = 5;</code>
     * @return bool
     */
    public function getAutoApproved()
    {
        return $this->auto_approved;
    }

    /**
     * True when the request has been auto-approved.
     *
     * Generated from protobuf field <code>bool auto_approved = 5;</code>
     * @param bool $var
     * @return $this
     */
    public function setAutoApproved($var)
    {
        GPBUtil::checkBool($var);
        $this->auto_approved = $var;

        return $this;
    }

}

