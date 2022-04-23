<?php

namespace Braincrafted\Bundle\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;

use Braincrafted\Bundle\BootstrapBundle\Util\LegacyFormHelper;

/**
 * StaticControlExtension
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Form
 * @author     André Püschel <pue@der-pue.de>
 * @copyright  2014 André Püschel
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class StaticControlExtension extends AbstractTypeExtension
{
    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['static_control'] = $form->getConfig()->getOption('static_control', false);
    }

    /**
     * Add the static_control option
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('static_control'));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* We need to set it to disabled, so Symfony ignores the fact that there is no
           data submitted back for this field (mapping=>false is only two way, so not usable) */
        if (isset($options['static_control']) && $options['static_control']) {
            $builder->setDisabled(true);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getExtendedTypes(): iterable
    {
        return [FormType::class];
    }
}
