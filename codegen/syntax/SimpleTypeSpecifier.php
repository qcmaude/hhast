<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<382e77a80033b9a23e65f8cc49b38e7f>>
 */
namespace Facebook\HHAST;
use namespace Facebook\TypeAssert;

<<__ConsistentConstruct>>
final class SimpleTypeSpecifier extends EditableNode {

  private EditableNode $_specifier;

  public function __construct(EditableNode $specifier) {
    parent::__construct('simple_type_specifier');
    $this->_specifier = $specifier;
  }

  <<__Override>>
  public static function fromJSON(
    dict<string, mixed> $json,
    string $file,
    int $offset,
    string $source,
  ): this {
    $specifier = EditableNode::fromJSON(
      /* UNSAFE_EXPR */ $json['simple_type_specifier'],
      $file,
      $offset,
      $source,
    );
    $offset += $specifier->getWidth();
    return new static($specifier);
  }

  <<__Override>>
  public function getChildren(): dict<string, EditableNode> {
    return dict[
      'specifier' => $this->_specifier,
    ];
  }

  <<__Override>>
  public function rewriteDescendants(
    self::TRewriter $rewriter,
    ?vec<EditableNode> $parents = null,
  ): this {
    $parents = $parents === null ? vec[] : vec($parents);
    $parents[] = $this;
    $specifier = $this->_specifier->rewrite($rewriter, $parents);
    if ($specifier === $this->_specifier) {
      return $this;
    }
    return new static($specifier);
  }

  public function getSpecifierUNTYPED(): EditableNode {
    return $this->_specifier;
  }

  public function withSpecifier(EditableNode $value): this {
    if ($value === $this->_specifier) {
      return $this;
    }
    return new static($value);
  }

  public function hasSpecifier(): bool {
    return !$this->_specifier->isMissing();
  }

  /**
   * @returns XHPClassNameToken | MixedToken | NameToken | IntToken | VarToken
   * | StringToken | SelfToken | ArrayToken | VoidToken | BoolToken |
   * FloatToken | ResourceToken | ThisToken | ParentToken | DoubleToken |
   * NumToken | ObjectToken | VecToken | DictToken | KeysetToken |
   * QualifiedName | ArraykeyToken | VarrayToken | DarrayToken | NoreturnToken
   */
  public function getSpecifier(): EditableNode {
    return TypeAssert\instance_of(EditableNode::class, $this->_specifier);
  }
}
