<?php

namespace Travidence\Model\Entity;


use Nette\SmartObject;

abstract class BaseEntity
{
    use OpenDataSerializable;
    use SmartObject;
}