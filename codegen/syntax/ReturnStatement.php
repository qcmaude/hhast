<?hh
/**
 * This file is generated. Do not modify it manually!
 *
 * @generated SignedSource<<e39c2d835bf74d8752f5c3d7b7057507>>
 */
namespace Facebook\HHAST;
use type Facebook\TypeAssert\TypeAssert;

final class ReturnStatement extends EditableSyntax {

  private EditableSyntax $_keyword;
  private EditableSyntax $_expression;
  private EditableSyntax $_semicolon;

  public function __construct(
    EditableSyntax $keyword,
    EditableSyntax $expression,
    EditableSyntax $semicolon,
  ) {
    parent::__construct('return_statement');
    $this->_keyword = $keyword;
    $this->_expression = $expression;
    $this->_semicolon = $semicolon;
  }

  public static function from_json(
    array<string, mixed> $json,
    int $position,
    string $source,
  ): this {
    $keyword = EditableSyntax::from_json(
      /* UNSAFE_EXPR */ $json['return_keyword'],
      $position,
      $source,
    );
    $position += $keyword->width();
    $expression = EditableSyntax::from_json(
      /* UNSAFE_EXPR */ $json['return_expression'],
      $position,
      $source,
    );
    $position += $expression->width();
    $semicolon = EditableSyntax::from_json(
      /* UNSAFE_EXPR */ $json['return_semicolon'],
      $position,
      $source,
    );
    $position += $semicolon->width();
    return new self($keyword, $expression, $semicolon);
  }

  public function children(): KeyedTraversable<string, EditableSyntax> {
    yield 'keyword' => $this->_keyword;
    yield 'expression' => $this->_expression;
    yield 'semicolon' => $this->_semicolon;
  }

  public function rewrite_children(
    self::TRewriter $rewriter,
    ?Traversable<EditableSyntax> $parents = null,
  ): this {
    $parents = $parents === null ? vec[] : vec($parents);
    $parents[] = $this;
    $keyword = $this->_keyword->rewrite($rewriter, $parents);
    $expression = $this->_expression->rewrite($rewriter, $parents);
    $semicolon = $this->_semicolon->rewrite($rewriter, $parents);
    if (
      $keyword === $this->_keyword &&
      $expression === $this->_expression &&
      $semicolon === $this->_semicolon
    ) {
      return $this;
    }
    return new self($keyword, $expression, $semicolon);
  }

  public function keyword(): ReturnToken {
    return $this->keywordx();
  }

  public function keywordx(): ReturnToken {
    return TypeAssert::isInstanceOf(ReturnToken::class, $this->_keyword);
  }

  public function raw_keyword(): EditableSyntax {
    return $this->_keyword;
  }

  public function with_keyword(EditableSyntax $value): this {
    return new self($value, $this->_expression, $this->_semicolon);
  }

  public function expression(): EditableSyntax {
    return $this->expressionx();
  }

  public function expressionx(): EditableSyntax {
    return TypeAssert::isInstanceOf(EditableSyntax::class, $this->_expression);
  }

  public function raw_expression(): EditableSyntax {
    return $this->_expression;
  }

  public function with_expression(EditableSyntax $value): this {
    return new self($this->_keyword, $value, $this->_semicolon);
  }

  public function semicolon(): ?SemicolonToken {
    return $this->_semicolon->is_missing() ? null : TypeAssert::isInstanceOf(SemicolonToken::class, $this->_semicolon);
  }

  public function semicolonx(): SemicolonToken {
    return TypeAssert::isInstanceOf(SemicolonToken::class, $this->_semicolon);
  }

  public function raw_semicolon(): EditableSyntax {
    return $this->_semicolon;
  }

  public function with_semicolon(EditableSyntax $value): this {
    return new self($this->_keyword, $this->_expression, $value);
  }
}